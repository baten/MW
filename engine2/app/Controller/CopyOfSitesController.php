<?php

App::uses('AppController', 'Controller');

class SitesController extends AppController {

	public $components = array('RequestHandler','EmailSender','Uploader');

	public $uses = array(	
		'User',
		'Menu',
		'ChildMenu',
		'WebPage',
		'WebPageDetail',
		'Subscriber',
		'SocialNetwork',
		'SiteSetting',
		'CurrencyValue',
		'Ecommerce.Product',
		'Ecommerce.RelatedProduct',
		'Ecommerce.Category',
		'Ecommerce.Brand',
		'Ecommerce.ProductBrand',
		'Ecommerce.Sale',
		'Ecommerce.Attribute',
		'Ecommerce.ProductCategory',
		'Ecommerce.ProductOrder',
		'Ecommerce.ProductOrderNote',
		'Ecommerce.Coupon',
		'Ecommerce.Team',
		'Ecommerce.Wishlist',
		'Timeout.Gallery',
		'Timeout.Banner',
		'Timeout.Client'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();		
	}

	public function changeCollation(){
		$this->autoRender=false;
		App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('default');
      	$dbname = $dataSource->config['database'];	   
        $results=$this->SiteSetting->query('show tables');
       foreach ($results as $key => $value) {
       		$tableName = $value['TABLE_NAMES']['Tables_in_'.$dbname];
       		$this->SiteSetting->query("ALTER TABLE $tableName CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
       }     
       echo "The collation has been successfully changed for database: ".$dbname;
	}

	
	public function  siteInfo(){
        $data = $this->SiteSetting->find('first');
        $this->set(
            array(
                '_serialize',
                'data' => array('siteInfo'=>$data),
                '_jsonp' => true

            )
        );
        $this->render('data_layout');
    }
	
	public function dataLayoutFn(){
		$postData = $this->request->input('json_decode',true);
		$this->Category->tablePrefix = $postData['tablePrefix'];
		$this->Menu->tablePrefix = $postData['tablePrefix'];
		$this->Menu->ChildMenu->tablePrefix = $postData['tablePrefix'];
		$this->Brand->tablePrefix = $postData['tablePrefix'];
		
		$Branddata = $this->Brand->find('all',array('fields'=>array('id','title','slug','logo_extension'),'order' => array('order'=>'ASC')));
		foreach($this->menu_locations as $key=>$value){
			$menu[$key] =  $this->Menu->find('threaded',
				array(
					'contain'=>array("ChildMenu"=>array('ChildMenu'=>array('conditions'=>array('status'=>'active')),'conditions'=>array('status'=>'active'))),
					'conditions'=>array(
						'status'=>'active',
							
						'location'=>"{$key}"
						),
						'fields'=>array('*'),
						'order' => array('order' => 'ASC')
						)
						);
		}
		$social_networks = $this->SocialNetwork->find('all',
			array(
				'conditions'=>array('status'=>'active'),
				'order' => array('order' => 'ASC')
			)
		);
		if(!empty($social_networks)){
			$menu['SocialNetwork'] = $social_networks;
		}
		$categories = $this->category_tree();
		if(!empty($categories)){
			$menu['Category'] = $categories;
		} 
		if(!empty($Branddata)){
			$menu['Brand'] = $Branddata;
		}

		$this->set(
				array(
					'_serialize',
					'data' => array('layoutData'=>$menu),
					'_jsonp' => true

				)
		);
		$this->render('data_layout');
	}
	
	// get Single Currency
	public function getSingleCurrency(){
		$this->autoRender = false;
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$id=$postData['id'];
			$data = $this->CurrencyValue->find(
				'first',
				array(
					'conditions'=>array('id'=>$id)
				)
			);
			$this->set(
				array(
					'_serialize',
					'data' => array('singleCurrencyValues'=>$data),
					'_jsonp' => true
						
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('singleCurrencyValues'=>'invalid data'),
					'_jsonp' => true
						
				)
			);
		}
			
		$this->render('data_layout');
	}
	
	//featured categories
	public function getFeaturedCategory(){
		$postData = $this->request->input('json_decode',true);
		$this->Category->tablePrefix = $postData['tablePrefix'];
		 $data = $this->Category->find(
		 	'all',
		 	array(
		 		'fields' => array('id','title','slug'),
		 		'contain' => array('CategoryImage'=>array('image_extension')),
		 		'conditions' => array('status' => 'active','is_featured' => 1),
		 		'order'=>array('order' => 'ASC'),
		 		'limit' => 4
		 		)
		 	);
		
		$this->set(
			array(
				'_serialize',
				'data' => array('featurededCategory'=>$data),
				'_jsonp' => true
		
			)
		);
		$this->render('data_layout');
	}
	
 

	//get web page by id
	public function web_page_by_id(){
		$postData = $this->request->input('json_decode',true);
		$this->WebPage->tablePrefix = $postData['tablePrefix'];
		$this->WebPage->WebPageDetail->tablePrefix = $postData['tablePrefix'];
		$data = $this->WebPage->find('first',array(
			'conditions'=>array(
				'slug' => $postData['slug']
			)
		));
		$this->set(
				array(
					'_serialize',
					'data' => array('singlePage'=>$data),
					'_jsonp' => true
				)
		);
		$this->render('data_layout');
	}
	
	 
	
	//slider image
	//banner
	public function banner()
	{
		$postData = $this->request->input('json_decode',true);
		$this->Banner->tablePrefix = $postData['tablePrefix'];
		$response = $this->Banner->find('all',array('conditions'=>array('status'=>'active')));//,array('order'=>array('order'=>'asc')));
		$this->set(
			array(
				'_serialize',
				'data' => array('banner' => $response),
				'_jsonp' => true
			)
		);
	
		$this->render('data_layout');
	}
	 
	 
	//new arrival products
	public function latestProductList(){
		if($this->request->is('post')){
	
			$postData = $this->request->input('json_decode',true);
			$this->Category->tablePrefix = $postData['tablePrefix'];
			$this->Product->tablePrefix = $postData['tablePrefix'];
			$order = array('created'=> 'DESC');
			$limit = 8;
			$cond = "Product.status = 'active'";
	
			$data = $this->Product->find(
				'all',
				array(
					'recursive'=>-1,
					'fields' => array('id','product_code','title','price','sale_price','slug','quantity'),
					'conditions'=>array('status'=>'active','sale_price' => 0),
					'contain'=>array('ProductImage'	=>array('order' => array('order'=>'ASC'),'limit'=>'1')),
					'order' => $order,
					'limit' => $limit
				)
			);
	
			$this->set(
				array(
					'_serialize',
					'data' => array('latestProductList'=>$data),
					'_jsonp' => true
				)
			);
	
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('latestProductList'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
	
		$this->render('data_layout');
	}
	
	//top sale products
	public function topSaleProductList(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$this->Product->tablePrefix = $postData['tablePrefix'];
			$order = array('created'=> 'DESC');
			$limit = 8;
			$cond = "Product.status = 'active'";
	
			$data = $this->Product->find(
				'all',
				array(
					'recursive'=>-1,
					'fields' => array('id'),
					'contain'=>array(
						'ProductImage'	=>array('order' => array('order'=>'ASC'),'limit'=>'1')
					),
					'fields' => array('id','product_code','title','price','sale_price','slug','sold'),
					'order' => array('sold' => 'DESC'),
					'conditions'=>array('status'=>'active'),
					'limit' => $limit
				)
			);
	
			$this->set(
				array(
					'_serialize',
					'data' => array('topSaleProduct'=>$data),
					'_jsonp' => true
				)
			);
	
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('topSaleProduct'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
	
		$this->render('data_layout');
	}
	
	//deal product list
	public function dealProductList(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$this->Product->tablePrefix = $postData['tablePrefix'];
			$cond = "status = 'active' AND sale_price > 0";
			$order = array('created'=> 'DESC');
			$page = 1;
			if(!empty($postData['ProductFilter'])){
				$conditionData = json_decode($postData['ProductFilter'],true);
					if(!empty($conditionData['pageNo'])){
				    	$page =$conditionData['pageNo'];
				   }	
			}
			 
			$productList=array();			
			$noOfProducts=0;
			$limit = 20;
			$noOfProducts = $this->Product->find(
				'count',
				array(
					'recursive' => -1,
					'conditions' => array( $cond),
				)
			);		
			$data = $this->Product->find(
				'all',
				array(
					'recursive' => -1,
					'contain'=>array('ProductImage'	=>array('order' => array('order' => 'ASC'),'limit'=>'1')),
					'conditions' => array($cond),
					'fields' 		=> array('id','title','slug','price','sale_price','quantity','options','status'),
					'order' 	=> $order,
					'limit'		 => $limit,
					'page'		 => $page
					
				)
			);
				 

				 
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceProductList'=>$data,'noOfProducts'=>$noOfProducts),
				'_jsonp' => true
			)
		);
	}else{
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceProductList'=>'Invalid Request'),
				'_jsonp' => true
			)
		);
	}
	$this->render('data_layout');
}

	public function singleProduct(){
		$response=array();
		if($this->request->is('post')){			
			$postData = $this->request->input('json_decode',true);
			$this->Product->tablePrefix = $postData['tablePrefix'];	
			$this->Attribute->tablePrefix = $postData['tablePrefix'];
			$this->Attribute->AttributeValue->tablePrefix = $postData['tablePrefix'];
			$datas = $this->Product->find(
				'first',
				array(
						'fields'=>array(
							'Product.id','Product.title','product_code','Product.slug','Product.description','Product.short_description','Product.price','Product.sale_price','(Product.purchased - (Product.sold + Product.demage)) as quantity'
						),
						'contain' 	=>array(
							'ProductImage' =>array('order' => array('order'=>'ASC')),
							'ProductAttribute' => array(
								'ProductAttributeValue'=>array('fields'=>array('attribute_value_id')),
								'fields'=>array('attribute_id')
								),
							'RelatedProduct'=>array('limit'=>4)
							),
						'conditions' => array('Product.slug' => $postData['slug'])
					)
				);
			$realtedProductIds=array();
			if(!empty($datas['RelatedProduct'])){
				$relatedProductData = $datas['RelatedProduct'];
				unset($datas['RelatedProduct']);
				$relatedProductsList = array();
				foreach($relatedProductData as $k=>$v){
					$realtedProductIds[] = $v['related_product'];
				}
			}
			$addedAttrInProduct = array_column($datas['ProductAttribute'],'attribute_id');
			$productAttribute = $this->Attribute->find(
				'all',
				array(
					'recursive'=>-1,
					'fields'=>array('id','title'),
					'contain' => array('AttributeValue'=>array('fields'=>array('id','value'))),
					'conditions'=>array('Attribute.id' => $addedAttrInProduct)
					)
				);
			$AttributeData= Set::extract('/Attribute/.', $productAttribute);
			$AttributevalueData= Set::extract('/AttributeValue/.', $productAttribute);
			if(count($datas)>0){
				$response = $datas;
				$response['Attribute'] = array_column($AttributeData,'title','id');
				$response['AttributeValue'] = array_column($AttributevalueData,'value','id');
				if(count($realtedProductIds)>0){
					$relatedProducts =  $this->Product->find(
						'all',
						array(
							'contain' 	=>array('ProductImage'=>array('order'=>array('order'=>'ASC'),'limit'=>1)),
							'fields' 		=> array('id','product_code','title','price','sale_price','slug','(Product.purchased - (Product.sold + Product.demage)) as quantity','status'),
							'conditions'=>array('id'=>$realtedProductIds)
						)
					);
					$response['RelatedProduct'] = $relatedProducts;
				}
				
			} 
			
		}   
		$this->set(
				array(
					'_serialize',
					'data' => array('productDatas'=>$response),
					'_jsonp' => true
				)
			);
		$this->render('data_layout');
	}
	
	public function getDiscount(){
		$response = [];
		$response['status']= 'error';
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$cupondCode = trim($postData['couponCode']);
			$datatime = date('Y-m-d h:i:s');
			 if(!empty($cupondCode)){
			 	$data = $this->Coupon->find(
			 		'first',
			 		array(
			 			'conditions'=>array('coupon_number' => $cupondCode,'status'=>'Active')
			 			)
		 			);
			 	if(!empty($data)){
			 		if(!empty($data['Coupon']['start_time']) || !empty($data['Coupon']['end_time'])){
			 			if(($data['Coupon']['start_time'] <=  $datatime) AND ($data['Coupon']['end_time'] >= $datatime)){
			 				$response['status']= 'success';
			 				$response['Coupon']= $data['Coupon'];
			 			}else{
			 				$response['message']= 'The discount code is out of date.';
			 			}
			 		}else{
			 			$response['status']= 'success';
			 			$response['Coupon']= $data['Coupon'];
			 		}
			 	}else{
			 		$response['message']= 'The discount code is not valid';
			 	} 
			 
			 }
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('couponData'=>$response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	//category data for left side category menu
	private function category_tree($params = null){
		$cond = array('status' => 'active');
		if(!empty($params)){
			$cond = array('status' => 'active','id' => $params);
		}
		$model = $this->Category;
		$data = $model->find('threaded',
				array(
				
					'contain' => array(
						'ChildCategory' => array(
						'Childcat'=>array('conditions'=>$cond,'fields' => array('id','parent_id','title','slug')),
						'fields' => array('id','title','slug'),
						'conditions'=>$cond
						),
					),
					'recursive'=> -1,
					'conditions'=>$cond,
					'fields' => array('id','parent_id', 'title','slug'),
					'order'  => array('order' => 'ASC'),
				)
			);
			 
			return $data;
	}
	
	

	/**
	 * product_list_by_category 
	 */
	public function productListByFeaturedCategory(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$this->Category->tablePrefix = $postData['tablePrefix'];
			$this->Category->ChildCategory->tablePrefix = $postData['tablePrefix'];
			$this->Product->tablePrefix = $postData['tablePrefix'];
			$cond = "Product.status = 'active'";
			$order = array('created'=> 'DESC');
			$page = 1;
			if(!empty($postData['ProductFilter']['pageNo'])){
		    	$page = $postData['ProductFilter']['pageNo'];
			}
			$isLast = null;
			if(!empty($postData['isLast'])){
				$isLast = 'y';
			}
			$categoryData = $this->categoryIds($postData['slug'],$isLast);
		
			$idds = $categoryData['idds'];
			$categoryObj = $this->Category->find(
				'first',array(
				'contain'=>array('CategoryImage'=>array('fields'=>array('thumb_extension'))),
				'conditions'=>array('Category.slug'=>$postData['slug']),
				'fields'=>array('slug','id','title','parent_id')
				));
			$productList=array();			
			$noOfProducts=0;
			if(count($categoryObj)>0){
					$categoryId=$categoryObj['Category']['id'];			
					$limit = 45;
					$noOfProducts = $this->Product->find(
						'count',
						array(
							'joins' => array(
								array(
									'table' => 'product_categories',
									'alias' => 'ProductCategory',
									'type' => 'INNER',
									'conditions' => array(
										'Product.id = ProductCategory.product_id'
									)
								)
							),
							'conditions' => array(
								$cond,
								'ProductCategory.category_id' => $idds,					
							),
							'group'=>'Product.id',
							
						)
					);		
					$data = $this->Product->find(
						'all',
						array(
							'joins' => array(
								array(
									'table' => 'product_categories',
									'alias' => 'ProductCategory',
									'type' => 'INNER',
									'conditions' => array(
										'Product.id = ProductCategory.product_id'
									)
								)
							),
							'contain'=>array('ProductImage'	=>array('order' => array('order' => 'ASC'),'limit'=>'1')),
							'conditions' => array(
								$cond,
								'ProductCategory.category_id' => $idds,					
							),
							'fields' 		=> array('id','title','slug','price','sale_price','unit','quantity','options','status'),
							'group'=>'Product.id',
							'order' 	=> $order,
							'limit'		 => $limit,
							'page'		 => $page
							
						)
					);
					$productList['category']['title'] = $categoryObj['Category']['title'];
					$productList['category']['id'] = $categoryObj['Category']['id'];
					$productList['category']['img'] = $categoryObj['CategoryImage']['thumb_extension'];
					//$productList['category']['parent_id'] = $categoryObj['Category']['parent_id'];
					if($data){
						$j=0;
						foreach($data as $key=>$val){
							$checkData=json_decode($val['Product']['options'],true);
							$val['Product']['options'] = $checkData;	
							$productList['Product'][$j]=$val;
							$j++;
						}		
						if(count($productList['Product']) > 0){
							$productList['Product'] = array_chunk($productList['Product'],15);
						}
					}
				}	
				
				//pr($productList);	
				$this->set(
					array(
						'_serialize',
						'data' => array('ecommerceProductList'=>$productList,'ecommerceCategory'=>$categoryData['Category'],'noOfProducts'=>$noOfProducts),
						'_jsonp' => true
					)
				);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceProductList'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('data_layout');
	}
	
	
	//product list by attribute
	public function getProductsByAttrFilter(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$productFilter = $postData['ProductFilter'];
			$this->Category->tablePrefix = $postData['tablePrefix'];
			$this->Category->ChildCategory->tablePrefix = $postData['tablePrefix'];
			$this->Product->tablePrefix = $postData['tablePrefix'];
			$request_attr_id = '';
			$request_attr_val_id = '';
			//attr filtes
			$cond = array();
			if(!empty($productFilter['filterRulesQuery'])){
				foreach(($productFilter['filterRulesQuery']) as $key=>$value){
					$request_attr_id[]= $key;
					foreach($value as $k=>$v){
						$request_attr_val_id[]= $v;
					}
				}
				
				$cond['ProductAttribute.attribute_id'] = $request_attr_id;
				$cond['ProductAttributeValue.attribute_value_id'] = $request_attr_val_id;
			}
			$cond['Product.status'] = 'active';
			if(!empty($productFilter['filterByTeam'])){
				$cond['Product.team_id'] = $productFilter['filterByTeam'];
			}
			if(!empty($productFilter['filterByPrice'])){
				$priceArray = explode(',', $productFilter['filterByPrice']);
				//$test = arry
				$price= array(
							'Product.price >= ' => $priceArray[0],
				      		'Product.price <= ' => $priceArray[1]
				     	);
				
					$cond = array_merge($cond,$price);
					
			}
		
			$order = array('created'=> 'DESC');
			$page = 1;
			if(!empty($productFilter['pageNo'])){
	    		$page = $productFilter['pageNo'];
			}
			$categoryIds = $this->categoryIds($postData['slug']);
			$idds = $categoryIds['idds'];
			if(!empty($idds)){
				$test['ProductCategory.category_id'] = $idds;
			}
			$categoryObj=$this->Category->find('first',array(
				'conditions'=>array('Category.slug'=>$postData['slug']),
				'fields'=>array('slug','id','title','parent_id')
			));
			$productList=array();
			$noOfProducts=0;
	
			if(count($categoryObj)>0){
				$categoryId=$categoryObj['Category']['id'];
				$limit = 45;
				$noOfProducts = $data = $this->Product->find(
					'count',
					array(
						'recursive' =>-1,
						'joins' => array(
							array(
								'table' => 'product_categories',
								'alias' => 'ProductCategory',
								'type' => 'INNER',
								'conditions' => array(
									'Product.id = ProductCategory.product_id'
								)
							),
							array(
								'table' => 'product_attributes',
								'alias' => 'ProductAttribute',
								'type' => 'INNER',
								'conditions' => array(
									'Product.id = ProductAttribute.product_id'
								)
							),
							array(
								'table' => 'product_attribute_values',
								'alias' => 'ProductAttributeValue',
								'type' => 'INNER',
								'conditions' => array(
									'ProductAttribute.id = ProductAttributeValue.product_attribute_id'
								)
							)
						),
						'conditions' => array($cond),
						'group'=>'Product.id',
					 
					)
				);
				$data = $this->Product->find(
					'all',
					array(
						'recursive' =>-1,
						'joins' => array(
							array(
								'table' => 'product_categories',
								'alias' => 'ProductCategory',
								'type' => 'INNER',
								'conditions' => array(
									'Product.id = ProductCategory.product_id'
								)
							),
							array(
								'table' => 'product_attributes',
								'alias' => 'ProductAttribute',
								'type' => 'INNER',
								'conditions' => array(
									'Product.id = ProductAttribute.product_id'
								)
							),
							array(
								'table' => 'product_attribute_values',
								'alias' => 'ProductAttributeValue',
								'type' => 'INNER',
								'conditions' => array(
									'ProductAttribute.id = ProductAttributeValue.product_attribute_id'
								)
							)
						),
						'contain'=>array('ProductImage'	=>array('order' => array('order'=>'ASC'),'limit'=>'1')),
						'conditions' => array($cond),
						'fields' 		=> array('id','title','slug','price','sale_price','unit','quantity','options','status'),
						'group'=>'Product.id',
						'order' 	=> $order,
						'limit'		 => $limit,
						'page'		 => $page
							
					)
				);
	
				$productList['category']['title'] = $categoryObj['Category']['title'];
				//$productList['category']['parent_id'] = $categoryObj['Category']['parent_id'];
				if($data){
				$j=0;
				foreach($data as $key=>$val){
					$checkData=json_decode($val['Product']['options'],true);
					$val['Product']['options'] = $checkData;
					$productList['Product'][$j]=$val;
					$j++;
				}
				if(count($productList['Product']) > 0){
					$productList['Product'] = array_chunk($productList['Product'],15);
				}
			}
			}
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceProductList'=>$productList,'noOfProducts'=>$noOfProducts),
					'_jsonp' => true
				)
			);
	
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceProductList'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
			
		$this->render('data_layout');
	}
	
	public function getAttributes(){
		$response = array();
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$this->Category->tablePrefix = $postData['tablePrefix'];
			$this->Team->tablePrefix = $postData['tablePrefix'];
			$this->Category->ChildCategory->tablePrefix = $postData['tablePrefix'];
			$this->Category->Childcat->tablePrefix = $postData['tablePrefix'];
			$this->Attribute->tablePrefix = $postData['tablePrefix'];
			$this->Attribute->AttributeValue->tablePrefix = $postData['tablePrefix'];
			$categoryIds = $this->categoryIds($postData['slug']);
			$categories = $categoryIds['idds'];
			$productCategories = $this->ProductCategory->find(
				'all',
				array(
					'recursive'=>-1,
					'fields' => array('product_id'),
					'conditions' =>array('category_id' => $categories)
					)
				);
			$productIds = array_column(array_column($productCategories,'ProductCategory'),'product_id');
			if(!empty($productIds)){
				$productAttribute = $this->Product->ProductAttribute->find(
					'all',
					array(
						'fields' =>array('attribute_id'),
						'contain' => array('ProductAttributeValue' => array('fields'=>array('attribute_value_id'))),
						'conditions'=>array('product_id' => $productIds)
						)
					);
				
				if(!empty($productAttribute)){
					$request_attr_id = '';
					$request_attr_val_id = '';
					//attr filtes
					foreach(($productAttribute) as $value){
						$request_attr_id[]= $value['ProductAttribute']['attribute_id'];
						if(!empty($value['ProductAttributeValue'])){
							foreach($value['ProductAttributeValue'] as $k=>$v){
								$request_attr_val_id[]= $v['attribute_value_id'];
							}
						}
						
					}
				}
				 
				$attributes = '';
				if(!empty($request_attr_val_id)){
					$attributes = $this->Attribute->find(
						'all',
						array(
							'contain'=>array('AttributeValue' => array('conditions' => array('id' => $request_attr_val_id))),
							'conditions' =>array('id' => $request_attr_id)
							)
						);
					$response['dataString'] = $attributes;
				} 
				
				$productTeams = $this->Product->find('all',array('recursive'=>-1,'group'=>array('team_id'),'fields'=>array('team_id'),'conditions'=>array('id'=>$productIds)));
				if(!empty($productTeams[0]['Product']['team_id'])){
					$teamIds = array_column(array_column($productTeams,'Product'),'team_id');
					if(!empty($teamIds)){
						$teamList = $this->Team->find('list',array('conditions'=>array('id'=>$teamIds)));
						$response['teamData'] = $teamList;
					}
				}
				
				$response['status'] = true;
			}else{
				$response['status'] = false;
			}
			 
		}else{
			$response['status'] = false;
		}
	
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceAttributes'=> $response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	public function brandCategoryList(){
		$response = array();
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$this->Brand->tablePrefix = $postData['tablePrefix'];
			$this->Category->tablePrefix = $postData['tablePrefix'];
			$this->Category->ChildCategory->tablePrefix = $postData['tablePrefix'];
			$this->Category->ChildCategory->Childcat->tablePrefix = $postData['tablePrefix'];
			$brand = $this->Brand->find(
				'first',
				array(
					'recursive' => 1,
					'fields' => array('id','title','meta_keys','meta_description','description','image_extension'),
					'conditions' => array('slug' => $postData['slug'])
					)
				);
			
		 
			$productCategories = $this->ProductBrand->find(
				'all',
				array(
					'recursive' =>-1,
					'fields'=>array('ProductCategory.id','ProductCategory.category_id'),
					'joins'=>array(
						array(
							'table' => 'product_categories',
							'alias' => 'ProductCategory',
							'type' => 'INNER',
							'conditions' => array(
								'ProductBrand.product_id = ProductCategory.product_id'
								)
							)
						),
					'conditions'=>array('ProductBrand.brand_id' => $brand['Brand']['id']),
					'group' => array('ProductCategory.category_id')
					)
				);
			if(!empty($productCategories)){
				$brandCategories = array_column(Set::extract('/ProductCategory/.', $productCategories),'category_id','id');
				$categories = $this->category_tree($brandCategories);
				$brand['Category'] = $categories;
			}
			$response['status'] = 'success';
			$response['message'] = $brand;
		}else{
			$response['status'] = 'error';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('brandCategories'=> $response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	//product list by brand
	public function brandProductList(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$this->Category->tablePrefix = $postData['tablePrefix'];
			$this->Product->tablePrefix = $postData['tablePrefix'];
			$brandSlug = $postData['brandSlug'];
			//$brandId = $postData['brandId'];
			$cond = "Product.status = 'active' AND Product.sale_price < 1 ";
			$order = array('created'=> 'DESC');
			$page = 1;
			if(!empty($postData['ProductFilter'])){
				$conditionData = json_decode($postData['ProductFilter'],true);
				if(!empty($conditionData['pageNo'])){
					$page =$conditionData['pageNo'];
				}
			}
			$productList=array();
			$noOfProducts=0;
			if(isset($brandSlug)){
				$brand = $this->Brand->find(
				'first',
				array(
					'recursive' => -1,
					'fields' => array('id'),
					'conditions' => array('slug' => $brandSlug)
					)
				);
				
				if(!empty($brand)){
					$limit = $this->numberOfProductsPerPage;
					//no of products
					$joinCatArray = '';
					if(isset($postData['catSlug'])){
						$joinCatArray = array(
							'table' => 'product_categories',
							'alias' => 'ProductCategory',
							'type' => 'INNER',
							'conditions' => array(
								'Product.id = ProductCategory.product_id'
							)
						);
						$catData = $this->Category->find(
							'first',
							array(
								'recursive' => -1,
								'fields' => array('id'),
								'conditions' => array('slug' => $postData['catSlug'])
							)
						);
						if(!empty($catData)){
							$cond .= " AND ProductCategory.category_id = '".$catData['Category']['id']."'";
						}
						
					}
					$joinArray = array(
								array(
									'table' => 'product_brands',
									'alias' => 'ProductBrand',
									'type' => 'INNER',
									'conditions' => array(
										'Product.id = ProductBrand.product_id'
									)
								),
								$joinCatArray
							);
					$noOfProducts = $this->Product->find(
						'count',
						array(
							'recursive' =>-1,
							'joins' => $joinArray,
							'conditions' => array(
								$cond,
								'ProductBrand.brand_id' => $brand['Brand']['id']
							),
							'group'=>'Product.id',
						)
					);
					//product list
					$data = $this->Product->find(
						'all',
						array(
							'recursive' =>-1,
							'joins' => $joinArray,
							'contain'=>array('ProductImage'	=>array('order' => array('order'=>'ASC'),'limit'=>'1')),
							'conditions' => array(
								$cond,
								'ProductBrand.brand_id' => $brand['Brand']['id']
							),
							'fields' 		=> array('id','title','slug','price','sale_price','quantity','options','status'),
							'group'=>'Product.id',
							'order' 	=> $order,
							'limit'		 => $limit,
							'page'		 => $page
						)
					);
					if(count($data) > 0){
						$productList['Product'] = array_chunk($data,15);
					}
				}
			}
			 
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceProductList'=>$productList,'noOfProducts'=>$noOfProducts),
					'_jsonp' => true
				)
			);
	
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceProductList'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
			
		$this->render('data_layout');
	}
	
	private function categoryIds($slug,$isLast = null){
		$data = $this->Category->find(
			'threaded',
			array(
				'fields' => array('id','parent_id','title','slug'),
				'contain' => array(
					'ChildCategory' => array(
						'Childcat'=>array('fields' => array('id','parent_id','title','slug')),
						'fields' => array('id','title','slug')
						),
					),
				'order'  => array('order' => 'ASC'),
				'recursive' => -1,
				'conditions' => array('Category.slug'=>$slug)
			)
		);
		
		$mainCategoryId = $data[0]['Category']['id'];
		$categoryIds=array();
		$newArray = array();
		$childCatArray = array();
		if(count($data[0]['ChildCategory'])>0){
			foreach ($data[0]['ChildCategory'] as $key => $value) {
				$newArray[] = $data[0]['ChildCategory'][$key]['id'];
				
				if(count($value['Childcat']) > 0 ){
					foreach ($value['Childcat'] as $k => $vl) {
						$childCatArray[] = $vl['id'];
					}
				}
			}
		}
		
		$categoryIds = array_merge($newArray,$childCatArray,array($mainCategoryId));
		$idds = array_unique($categoryIds);
		 
		if(!empty($isLast)){
			if(!empty($data[0]['Category']['parent_id'])){
				$newData = $this->Category->find(
					'threaded',
					array(
						'fields' => array('id','parent_id','title','slug'),
						'contain' => array(
							'ChildCategory' => array(
								'Childcat'=>array('fields' => array('id','parent_id','title','slug')),
								'fields' => array('id','title','slug')
							),
						),
						'order'  => array('order' => 'ASC'),
						'recursive' => -1,
						'conditions' => array('Category.id'=>$data[0]['Category']['parent_id'])
					)
				);
			}else{
				$newData = $data;
			}
			
		}else{
			$newData = $data;
		}
		$returnData['Category'] = $newData;
		$returnData['idds'] = $idds;
		
		return $returnData;
	}
	
	/* ----------------order section */
	
	public function stockAvailibility(){
		$response = array();
		if($this->request->is('post')){
			$post_data = $this->request->input('json_decode',true);
		 	$productIds = array_keys(json_decode($post_data['productIds'],true));
			$data = $this->Product->find(
				'list',
				array(
					'fields'=>array('id','quantity'),
					'conditions' => array('id' => $productIds)
				)
			);
			$response['stockQuantity'] = $data;
		
		} 
		
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceCheckout'=> $response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	/* ----------------order section */
	
	
	
	/**
	 * checkout
	 */
	public function order(){
		if($this->request->is('post')){
			$post_data = $this->request->input('json_decode',true);
			//pr($post_data);die();
			$outOfStockProducts = $this->checkAvailableProductInstock($post_data['cart']);
			if(sizeof($outOfStockProducts) < 1){
				//pr($post_data);
				$shippingDetails = $post_data['shippingDetail'];
				
				if(isset($shippingDetails['shippingCost'])){
					$shippingDetails['shipping_cost'] = $shippingDetails['shippingCost'];
				
				}
				$orderDetail['cart'] = $post_data['cart'];
				if(isset($post_data['discount'])){
					$orderDetail['discount'] = $post_data['discount'];
				}
				$couponId = '';
				if(isset($post_data['couponData'])){
					$orderDetail['couponData'] = $post_data['couponData'];
					$couponId = $post_data['couponData']['couponId'];
				}
				if(isset($shippingDetails['paymentMethod'])){
					$shippingDetails['paymentMethod'] = $shippingDetails['paymentMethod'];
				}
				
				//$clientDetails = $post_data['userDetail'];
					
				//pr($details);
				
				$ready_data['ProductOrder']['order_detail'] 	= json_encode($orderDetail);
				$ready_data['ProductOrder']['shipping_detail']	= json_encode($shippingDetails);
				$ready_data['ProductOrder']['status'] 			= 'ordered';
				
				$clientDetails = $post_data['userDetail'];
				$userData = array();
				$userData['username'] = $clientDetails['username'];
				$updated = true;
				if($post_data['accountSatus'] == 'registered'){
					$userData['id'] = $clientDetails['id'];
					unset( $clientDetails['id'],$clientDetails['username']);
					
					$userData['details'] = json_encode($clientDetails);
					$updated = $this->updateClientInfo($userData);
					$userData['details'] = json_encode(array_merge($clientDetails,$post_data['clientAddressStr']));
					$ready_data['ProductOrder']['client_detail'] 	= json_encode($userData);
					
				}else {
					if($post_data['accountSatus'] == 'registration'){
					
						$userData['status'] = 'active';
						$userData['password'] = $clientDetails['password'];
						unset($clientDetails['username'],$clientDetails['password']);
						$userData['details'] = json_encode($clientDetails);
						$updated = $this->updateClientInfo($userData);
						unset($userData['status'],$userData['password']);
						$userData['details'] = json_encode(array_merge($clientDetails,$post_data['clientAddressStr']));
						$ready_data['ProductOrder']['client_detail'] 	= json_encode($userData);
					}else{
						unset($clientDetails['username'],$clientDetails['password']);
						$userData['details'] = json_encode(array_merge($clientDetails,$post_data['clientAddressStr']));
						$ready_data['ProductOrder']['client_detail'] 	= json_encode($userData);
					}
				}
				//pr($updated);die();
				//$this->updateClientInfo($clientDetails);
				//pr($ready_data);
			 	if($updated){
					if($this->ProductOrder->save($ready_data)){
					
						$order_id = $this->ProductOrder->getInsertId();
						if(!empty($couponId)){
							$this->alterCouponStatus($couponId);
						}
						$response['status'] = true;
						//$response['message'] = $payment_url;
						$response['orderId'] = $order_id;
						if($shippingDetails['paymentMethod'] == 'cod'){
							$orderData = $this->ProductOrder->find('first',array('recursive'=>0,'conditions'=>array('ProductOrder.id'=>$order_id)));
							if(!empty($orderData)){
								$this->sendOrderEmail($orderData);
							}
						}
						$response['message'] = $updated;
					}else{
						$response['status'] = false;
						$response['message'] = 'Please try fgfghfgh';
					}
				}else{
					$response['status'] = false;
					$response['message'] = 'Please try again.';
				}  
				 
			}else{
				$response['status'] = false;
				$response['outOfStockProducts'] = $outOfStockProducts; 
			}
				 
		}else{
			$response = array('message'=>'Invalid Request');
		}
	
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceCheckout'=> $response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	
	}
	
	public function payFort(){
		if($this->request->is('post')){
			
			
			$test = '{"sub_total":"900","cart_items":[{"item_description":"
		Xbox","item_image":"http://image.com","item_name":"Xbo
		x 360","item_price":"300","item_quantity":"2"},{"item_description":"Playstation 
		3","item_image":"http://image.com","item_name":"Playstation 3","item_price":"150","item_quantity":"2"}]}';
			//pr(json_decode($abc,true));
			$response['status'] = 'success';
			$params['command'] = 'PURCHASE';
			$params['merchant_identifier']='Cyc0HZ9xV6j';
			$params['access_code']= 'zx0IPmPy5jp1vAz8Kpg7';
			$params['signature'] = '7cad05f0212ed933c9a5d5dffa31661acf2c827a';
			$params['customer_email'] = 'abdulbaten1983@gmail.com';
			$params['currency'] = 'USD';
			$params['amount']= 10000;
			$params['language']='en';
			$params['token_name']='Op9Vmp';
			$params['merchant_reference'] = 'XYZ9239-yu898';
			$params['customer_name']='Abdul Baten';
			$params['customer_ip']='192.178.1.10';
			$params['payment_option'] = 'VISA';
			$params['return_url'] = 'http://themetumblr.net/engine/sites/paymentsuccess';
			
			//$params['cart_details']= $test;
			
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL , 'https://sbcheckout.payfort.com/FortAPI/paymentPage');
			curl_setopt($ch,CURLOPT_HTTPGET ,true);
			curl_setopt($ch, CURLOPT_POSTFIELDS , $params);
			$result2 = curl_exec($ch);
			curl_close($ch);
			pr(json_decode($result2,true));
			
			
		}else{
			$response['status'] = 'error';
		}
		
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceCheckout'=> $result2),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	/**
	 * get wish list products
	 */
	public function viewWishList(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			
			$clientId=$postData['clientId'];
			$this->Product->tablePrefix = $postData['tablePrefix'];
			
			$order = array('Wishlist.id'=> 'DESC');
			$page = 1;
			if(!empty($postData['ProductFilter'])){
				$conditionData = json_decode($postData['ProductFilter'],true);
					if(!empty($conditionData['pageNo'])){
				    	$page =$conditionData['pageNo'];
				   }	
			}
			 
			$productList = array();			
			$noOfProducts = 0;
			$limit = $this->numberOfProductsPerPage;
			$noOfProducts = $this->Product->Wishlist->find(
					'count',
					array('conditions' => array('client_id'=>$clientId))
				);
					
			$data = $this->Product->find(
				'all',
				array(
				'joins' => array(
						array(
							'table' => 'wishlists',
							'alias' => 'Wishlist',
							'type' => 'INNER',
							'conditions' => array(
								'Product.id = Wishlist.product_id'
							)
						)
					),
					'contain'=>array(
						'ProductImage'	=>array('order' => array('order' => 'ASC'),'limit'=>'1'),
						),
					'conditions' => array(
						'Product.status' => 'active',
						'Wishlist.client_id' => $clientId
						
					),
					'fields' 		=> array('Product.id','Product.title','Product.slug','Product.short_description','Wishlist.id'),
					'order' 	=> $order,
					'limit'		 => $limit,
					'page'		 => $page
					
				)
			);
			//pr($data);	 
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceProductList'=>$data,'noOfProducts'=>$noOfProducts),
					'_jsonp' => true
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceProductList'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('data_layout');
	}
	
	/**
	 * check wish list products
	 */
	public function checkWishList(){
		if($this->request->is('post')){
		$response=array();
		$postData = $this->request->input('json_decode',true);
		$clientId=$postData['clientId'];
		$data = $this->Wishlist->find('list',array('conditions'=>array('client_id'=>$clientId)));
		if(count($data)>0){
			$response=$data;
		}
		$this->set(
				array(
					'_serialize',
					'data' => array('checkListProducts'=>$response),
					'_jsonp' => true
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('checkListProducts'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('data_layout');
	}
	
		/**
	 * add wish list products
	 */
	public function addWishList(){
		$response=array();
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			
			$clientId=$postData['clientId'];
			$data['Wishlist']['client_id']= $clientId;
			$data['Wishlist']['product_id']= $postData['productId'];
			
			$this->Wishlist->create();
			if($this->Wishlist->save($data)){
				$response['wishListProducts'] =$this->Wishlist->find('list',array('conditions'=>array('client_id'=>$clientId)));
				$response['message']='Successfully Added';
			}else{
				$response['wishListProducts']='';
				$response['message']='Invalid Request';
			}
		
		}else{
			$response['wishListProducts']='';
			$response['message']='Invalid Request';
			
		}		
		$this->set(
				array(
					'_serialize',
					'data' => array('wishListProducts'=>$response),
					'_jsonp' => true
				)
			);
		$this->render('data_layout');
	}



	/**
	 * remove wish list products
	 */
	public function removeWishList(){
		$response=array();
		if($this->request->is('post')){
		$postData = $this->request->input('json_decode',true);
		$this->Wishlist->id = $postData['wishlistId'];
		if($this->Wishlist->delete()){
			$response['status'] = true;
			$response['message'] = 'The Wish list product has been deleted.';
		}else{
			$response['status'] = false;
			$response['message'] = 'The Wish list product could not be deleted. Please, try again.';
		}
		 
		}else{
			$response['status'] = false;
			$response['message'] = 'Invalid Request';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('remeveStatus'=>$response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	
	//update update free merchant info
	private function updateClientInfo($data){
		if(!empty($data)){
			$this->Client->create();
			if($this->Client->save($data)){
				if(!empty($data['id'])){
					$id = $data['id'];
				}else{
					$id = $this->Client->id;
				}
				$userData = $this->Client->findById($id);
				return $userData;
			}else{
				return false;
			}
		}else{
			return false;
		}
	
	
	}
	
	 
	
	public function order_status(){
	
		if($this->request->is('POST')){
			$cilentData = array();
			$postData =  $this->request->input('json_decode',true);
			$data = $this->ProductOrder->find('first',array('recursive'=>0,'conditions'=>array('ProductOrder.id'=>$postData['orderId'])));
			
			if(!empty($data)){
				$siteSettingData = $this->SiteSetting->getSiteSettingId();
				$cilentData['SiteSetting'] = $siteSettingData['SiteSetting'];
				$cilentData['clientDetail'] = $data['ProductOrder']['client_detail'];
				$cilentData['orderDetail'] = $data['ProductOrder']['order_detail'];
				$cilentData['shippingDetail'] =$data['ProductOrder']['shipping_detail'];
				$cilentData['paymentDetail'] =$data['ProductOrder']['payment_detail'];
				$cilentData['orderDate'] =$data['ProductOrder']['order_date'];
				$cilentData['orderId'] =  $data['ProductOrder']['id'];
				$clientDetailss = json_decode($cilentData['clientDetail'],true);
	
				$response['status'] = true;
				$responseData['orderId'] =  $data['ProductOrder']['id'];
				$responseData['billingDetails'] =  json_decode($data['ProductOrder']['client_detail'],true);
				$responseData['shippingDetails'] =  json_decode($data['ProductOrder']['shipping_detail'],true);
				$responseData['orderDetails'] =  json_decode($data['ProductOrder']['order_detail'],true);
				$responseData['paymentStatus'] = $data['ProductOrder']['payment_status'];
				$responseData['paymentDetail'] =json_decode($cilentData['paymentDetail'],true);
				$responseData['orderDate'] = $cilentData['orderDate'];
				//$responseData['orderStatus'] =  json_decode($data['ProductOrder']['order_detail'],true);
				$response['message'] = $responseData;
			}else{
				$response['status'] = true;
				$response['message'] = 'Something wrong';
			}
	
		}else{
			$response['status'] = false;
			$response['message'] = 'Invalid Request';
		}
	
		//sent to site
		$this->set(
			array(
				'_serialize',
				'data' => array('orderPaymentStatus'=>$response),
				'_jsonp' => true
			)
		);
	
		$this->render('data_layout');
	
	
	}
	
	/*
	 * shoping history
	*/

	public function shoping_history(){

		if($this->request->is('post')){
			$post_data = $this->request->input('json_decode',true);
			
			$client_id = $post_data['client_id'];

			$cond="ProductOrder.status = 'ordered'";				
			$order = array('ProductOrder.order_date'=> 'DESC');
			$page = 1;
			$limit = $this->numberOfProductsPerPage;
			$noOfProducts = 0;		
			if(!empty($post_data['ProductFilter'])){
				$conditionData = json_decode($post_data['ProductFilter'],true);				

				if(!empty($conditionData['pageNo'])){
			    	$page = $conditionData['pageNo'];
			   }

			   if(!empty($conditionData['order_status'])){			    	
			    	$cond = "ProductOrder.status = '".$conditionData['order_status']."'";
			   }	
			  
			}

			$noOfProducts = $this->ProductOrder->find(
				'count',
				array(
					'conditions' => array(
						'client_detail LIKE' => "%$client_id%",
						$cond
					),
					'recursive'=>-1
				)
			);
			
			//ordered
			//pr($datas);
			$datas = $this->ProductOrder->find(
				'all',
				array(
					'conditions' => array(
							'client_detail LIKE' => "%$client_id%",
							$cond
					),
					'order'		 => $order,
					'limit'		 => $limit,
					'page'		 => $page,
					'recursive'=>-1
				)
			);			
			if(count($datas)>0){
				$response=$datas;
			}else{
				$response=array();
			}
				
		}else{
			$response = array('message'=>'Invalid Request');
		}

		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceHistory'=>$response,'noOfProducts'=>$noOfProducts),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	 
	
	
	//search product list
	public function searchProductList(){
		$response = array();
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$this->Product->tablePrefix = $postData['tablePrefix'];
			$data = $this->Product->find(
				'all',
				array(
					'recursive'=>-1,
					'contain' 	=>array('ProductImage'=>array('limit'=>1)),
					'conditions' => array("title LIKE '%".addslashes($postData['searchProduct'])."%'"),
					'fields' 		=> array('id','product_code','title','price','sale_price','slug','quantity','unit','status','options'),
					'limit'		 => 40
				)
			);				
			
			$productList = array();			
			foreach($data as $key=>$val){			
				array_push($productList, $val);				
			}
	
				
			if(!empty($productList)){
				$response = $productList;
			}
							
				
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceSearchProductList'=>$response),
					'_jsonp' => true
				)
			);
		}else{			
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceSearchProductList'=>$response),
					'_jsonp' => true
				)
			);
		}
	
		$this->render('data_layout');
	}
	
	// success method
	
	function paymentsuccess(){
		$post_data = $_POST;
		pr($post_data);die();
	/* 	if(!empty($post_data)){
			$orderId = substr($post_data['tran_id'], 6);
			$data['ProductOrder']['payment_status'] = 'OK';
			$data['ProductOrder']['payment_detail'] = json_encode($post_data);
			$this->ProductOrder->id = $orderId;
			if($this->ProductOrder->save($data)){
	
				$dataa = $this->ProductOrder->find('first',array('recursive'=>0,'conditions'=>array('id'=>$orderId)));

				if(!empty($data)){
					$this->sendOrderEmail($dataa);
				}
				$this->redirect(SITE . "/order/".$orderId);
			}
	
		} */
	 
	}
	
	// fail or cancel method
	
	// success method
	
	function paymentfail(){
		$post_data = $_POST;
		if(!empty($post_data)){
			$orderId = substr($post_data['tran_id'], 6);
			$this->redirect(SITE . "/order/".$orderId.'/paymentFail');
	
		}
	
	}
	
	public function sendOrderEmail($data = null){
		
		if($data){
			$siteSettingData = $this->SiteSetting->getSiteSettingId();
			$cilentData['SiteSetting'] = $siteSettingData['SiteSetting'];
			$cilentData['clientDetail'] = $data['ProductOrder']['client_detail'];
			$cilentData['orderDetail'] = $data['ProductOrder']['order_detail'];
			$cilentData['shippingDetail'] = $data['ProductOrder']['shipping_detail'];
			$cilentData['paymentDetail'] =$data['ProductOrder']['payment_detail'];
			$cilentData['orderDate'] =$data['ProductOrder']['order_date'];
			$cilentData['orderId'] =  $data['ProductOrder']['id'];
			$clientDetailss = json_decode($cilentData['clientDetail'],true);
			//send email
			//$emailConfig['from_email'] = 'info@nrbbuysell.com'; //'joopdeyn@msn.com';
			$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
			$emailConfig['from_name'] =$siteSettingData['SiteSetting']['company_name'];
			$emailTo = $clientDetailss['username'];
			$emailConfig['to'] = $emailTo;
				
			//$emailConfig['to'] = "razibdpi@gmail.com";
				
			$emailConfig['subject'] = 'Payment Success for Invoice: '.$cilentData['orderId'];
			$emailConfig['template'] = 'ordersuccess';
			$emailConfig['data'] = $cilentData;
			$this->EmailSender->sendEmail($emailConfig);
				
			$response['status'] = true;
			$responseData['orderId'] =  $data['ProductOrder']['id'];
			$responseData['billingDetails'] = json_decode($data['ProductOrder']['client_detail'],true);
			$responseData['shippingDetails'] =  json_decode($data['ProductOrder']['shipping_detail'],true);
			$responseData['orderDetails'] =  json_decode($data['ProductOrder']['order_detail'],true);
			$responseData['paymentStatus'] = $data['ProductOrder']['payment_status'];
			$responseData['paymentDetail'] =json_decode($cilentData['paymentDetail'],true);
			$responseData['orderDate'] = $cilentData['orderDate'];
			$response['message'] = $responseData;
		}else{
			$response['status'] = true;
			$response['message'] = 'Something wrong';
		}
	
		return $response; 
	}
	
	private function cartProducts($data){
		$productQuantity = array();
		$productId = array();
		foreach($data as $datum){
			if(in_array($datum['productId'],$productId)){
				$productQuantity[$datum['productId']] = ($productQuantity[$datum['productId']] + $datum['productQuantity']);
			}else{
				$productQuantity[$datum['productId']] = $datum['productQuantity'];
				$productId[] = $datum['productId'];
			}
		
		}
		
		return $productQuantity;
	}
	
	private function updateProductStock($productArr){
		$products = $this->cartProducts($productArr);
		
		foreach($products as $key => $value){
			$this->Product->query("UPDATE products SET quantity = (quantity - $value) WHERE id = '".$key."'");
			$this->Product->query("UPDATE english_products SET quantity = (quantity - $value) WHERE id = '".$key."'");
		}
		return true;
	}
	
	private function alterCouponStatus($couponId){
		$this->Coupon->id = $couponId;
		$this->Coupon->saveField('status','Inactive');
		return true;
	}
	// check available product in stock
	
	private function checkAvailableProductInstock($data){
		$productQuantity = $this->cartProducts($data);
		$notAvailableProduct = array();
		$data = '';
		foreach($productQuantity as $key => $val){
			$data = $this->Product->find(
				'first',
				array(
					'recursive'=>-1,
					'fields'=>array('id','title','purchased - (sold + demage) as quantity'),
					'conditions'=>array('id'=>$key)
				)
			);
			if($data[0]['quantity'] < $val){
				$notAvailableProduct[$data['Product']['id']] = array('title' => $data['Product']['title'],'quantity'=>$data[0]['quantity']);
			}
		}
		return $notAvailableProduct;
	}
	
	
	/* client area */
	
	/*
	 * cleint registraion
	*/
	public function client_registration(){
		if($this->request->is('post')){
			$data =  $this->request->data;
			
			if(!empty($data['repassword'])){
				unset($data['repassword']);
			}
			if(!empty($data['country'])){
				$data['details']['country'] = $data['country'];
			}
			if(!empty($data['state'])){
				$data['details']['state'] = $data['state'];
			}
			$cilentData = array();
			$cilentData['Client']['username'] = $data['username'];
			$cilentData['Client']['password'] = $data['password'];
			$cilentData['Client']['details'] = json_encode($data['details']);
			
			$cilentData['Client']['status'] = 'active';
			$cilentData['Client']['status'] = 'active';
			if($this->Client->find('count',array('conditions'=>array('username'=>$cilentData['Client']['username']))) > 0){
				$return_data = array();
				$return_data['status'] = 'error';
				$return_data['message'] = 'Already registered.';
			}else{
				if($this->Client->save($cilentData)){
					$lastData = $this->Client->findById($this->Client->id);
	
					$siteSettingData = $this->SiteSetting->getSiteSettingId();
					//send email
	
					$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
					$emailConfig['from_name'] = $siteSettingData['SiteSetting']['company_name'];
	
					$emailConfig['to'] = $cilentData['Client']['username'];
					$emailConfig['subject'] = 'Registration';
					$emailConfig['template'] = 'registration';
					$emailConfig['data'] = $cilentData;
					//$this->EmailSender->sendEmail($emailConfig);
	
					$return_data = array();
					$return_data['status'] = 'success';
					unset($return_data['Client']['password']);
					$return_data['loggeduser'] = $lastData;
					$return_data['message'] = 'Registration has been completed.';
				}else{
					$return_data = array();
					$return_data['status'] = 'error';
					$return_data['message'] = 'Can not be procced.';
				}
			}
		}else{
			$return_data = array();
			$return_data['status'] = 'error';
			$return_data['message'] = 'Invalid Request.';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('registerClient'=>$return_data),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	 
	
	//client login.
	public function client_login(){
		$response = array();
		if($this->request->is('post')){
			$data =  $this->request->input('json_decode',true);
	
			if(isset($data[0])){
				$username = $data[0]['username'];
				$password = $data[0]['password'];
	
				//check user auth credential
				$is_valid_user = $this->Client->processLogin($username,$password);
				if($is_valid_user != 'error'){
					unset($is_valid_user['Client']['password']);
					$response['status'] = 'success';
					$response['loggeduser'] = $is_valid_user;
				} else {
					$response['status'] = 'error';
					$response['message'] = 'Username and Password does not match or you are not a valid user.';
				}
			}else {
				$response['status'] = 'error';
				$response['message'] = 'Username and Password does not match or you are not a valid user.';
			}
			//block other type of request.
		}else{
			$response['status'] = 'error';
			$response['message'] = 'Invalid Request.';
		}
	
		$this->set(
			array(
				'_serialize',
				'data' => array('clientLogin'=>$response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	/**
	 *update client profile
	 */
	public function client_profile(){
		$response = array();
		if($this->request->is('post')){
			$data =  $this->request->input('json_decode',true);
			$profile_data = array();
			//get current profile
			if($data['action'] == 'get_data'){
				if(!empty($data['clientId'])){
					$profile_data = $this->Client->find(
						'first',
						array(
							'conditions'=> array(
								'id' => $data['clientId']
							)
						)
					);
					if(!empty($profile_data)){
						$profile_data['Client']['details'] = json_decode($profile_data['Client']['details'],true);
					}
				}
	
				$response = $profile_data;
				$response['status'] = 'success';
			}
			//update profile
			else{
				$salt_data=array();
				if(!empty($data['newData'])){
					foreach($data['newData'] as $key=>$value){
						if(!empty($value)){
							$profile_data[$value['name']] = $value['value'];
						}
					}
					$new_profile_data['Client']['details'] = json_encode($profile_data);
					$this->Client->id = $data['clientId'];
					if($this->Client->save($new_profile_data)){
						$salt_data = $this->Client->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$data['clientId'])));
					}
				}
				$response['message'] = 'Profile has been updated';
				$response['loggeduser'] = $salt_data;
			}
		}
	
		$this->set(
			array(
				'_serialize',
				'data' => array('clientInfo'=>$response),
				'_jsonp' => true
			)
		);
	
		$this->render('data_layout');
	}
	
	/*
	 * check current password
	*/
	public function check_current_password(){
		if($this->request->is('post')){
			$post_data =  $this->request->input('json_decode',true);
			$current_data = $this->Client->find('first',array('conditions'=>array('id'=> $post_data['clientId'])));
			$password_is_valid = $this->Client->processLogin($current_data['Client']['username'], $post_data['currentPassword']);
			if($password_is_valid == 'error'){
				$passwordValidation['status'] = false;
				$passwordValidation['message'] = 'Password does not match';
			}else{
				$passwordValidation['status'] = true;
				$passwordValidation['message'] = '';
			}
		}
		else{
			$passwordValidation['status'] = false;
			$passwordValidation['message'] = 'Invalid request';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('clientPasswordCheck'=>$passwordValidation),
				'_jsonp' => true
			)
		);
	
		$this->render('data_layout');
	
	}
	/**
	 * update password
	 */
	public function update_password(){
		if($this->request->is('post')){
			$post_data =  $this->request->input('json_decode',true);
	
			$this->Client->id = $post_data['clientId'];
			$update_data['Client']['password'] = $post_data['newPassword'];
			if($this->Client->save($update_data)){
				$response['status'] = true;
				$response['message'] = 'Password has been updated';
			}else{
				$response['status'] = false;
				$response['message'] = 'Password can not be updated';
			}
	
		}else{
			$response['message'] = 'Invalid Request';
		}
	
		$this->set(
			array(
				'_serialize',
				'data' => array('clientUpdatePassword'=>$response),
				'_jsonp' => true
			)
		);
	
		$this->render('data_layout');
	}
	
	//request for forgot password
	public function forget_password(){
		$response = array();
		$response['status'] = 'error';
		$response['message'] = 'Invalid Request';
		if ($this->request->is('post')) {
			$post_data = $this->request->input('json_decode', true);
			if(!empty($post_data['forgetEmail'])){
				$checkUser = $this->Client->checkValidUser($post_data['forgetEmail']);
				if (!empty($checkUser)) {
					$this->Client->id = $checkUser['Client']['id'];
					$token = $checkUser['Client']['id'] . time();
					$str = $token . '~' . $post_data['forgetEmail'];
					$strPrm = base64_encode($str);
					//pr(base64_decode($strPrm));
					if ($this->Client->saveField('token', $token)) {
						$siteSettingData = $this->SiteSetting->getSiteSettingId();
						$Subject = 'Forgotten password request';
						//mail body
						$Email = "To change your password, please click on this link : ".SITE."/fp/$strPrm " . "\r\n" .
							"If you did not request this change, you do not need to do anything." . "\r\n" .
	
							"Thank you for stay with us." . "\r\n" .
	
							"Sincerely, " . "\r\n" .
							SITENAME;
	
						$To = $post_data['forgetEmail'];
						//$From = 'info@timeoutstore.com';
						$From = $siteSettingData['SiteSetting']['site_author_email'];
						$Headers = "From: $From" . "\r\n" .
							"CC: $From";
						mail($To, $Subject, $Email, $Headers, $From);
	
						$response['status'] = 'success';
						$response['message'] = 'Please check your mail.';
						//$response['data'] = $strPrm;
					}
	
				} else {
					$response['status'] = 'error';
					$response['message'] = 'Invalid Username';
				}
	
			}else{
				$response['status'] = 'error';
				$response['message'] = 'Invalid Request';
			}
		}else{
			$response['status'] = 'error';
			$response['message'] = 'Invalid Request';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('confirmation' => $response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	//create new password for forgotten password
	public function createNewPassword()
	{
		if ($this->request->is('post')) {
			$post_data = $this->request->input('json_decode', true);
			$strTokenInfo = explode('~', base64_decode($post_data['tokenInfo']));
			$checkUser = $this->Client->checkValidUser($strTokenInfo[1], $strTokenInfo[0]);
			if (!empty($checkUser)) {
				$this->Client->id = $checkUser['Client']['id'];
				$update_data['Client']['password'] = $post_data['password'];
				$update_data['Client']['token'] = '';
				if ($this->Client->save($update_data)) {
					$response['status'] = 'success';
					$response['message'] = 'Password has been updated';
				} else {
					$response['status'] = 'error';
					$response['message'] = 'Password can not be updated';
				}
					
			} else {
				$response['status'] = 'error';
				$response['message'] = 'Invalid Request';
			}
	
		} else {
			$response['status'] = 'error';
			$response['message'] = 'Invalid Request';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('data' => $response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	//subscribe
	public function subscribe(){
		$this->autoRender = false;
		$reponse = array();
		if($this->request->is('post')){
			$postData = $this->request->data;
			//pr($this->request->data);
			$token = base64_encode(Security::hash($postData['email'], 'blowfish', false));
			$data['Subscriber']['email'] = $postData['email'];
			$data['Subscriber']['token'] = $token;
			$subscriberData = $this->Subscriber->find(
				'first',
				array(
					'fields'=>array('id','email','token','status'),
					'conditions'=>array('email'=>$postData['email']
					)
				)
			);
			//die();
			$varificatin = 'verification';
			if(count($subscriberData) > 0){
				$this->Subscriber->id = $subscriberData['Subscriber']['id'];
				if($subscriberData['Subscriber']['token'] == ''){
					$this->Subscriber->saveField('token',$token);
					//mail goes here
					$data['status'] = $varificatin;
					$this->sendEmail($data);
					$reponse['status'] = 'success';
					$reponse['message'] = 'Please check your mail.';
				}else{
					if($subscriberData['Subscriber']['status'] == 'active'){
						$reponse['status'] = 'error';
						$reponse['message'] = 'Already Subscribed.';
					}else{
						$this->Subscriber->saveField('token',$token);
						//mail goes here
						$data['status'] = $varificatin;
						$this->sendEmail($data);
						$reponse['status'] = 'success';
						$reponse['message'] = 'Please check your mail.';
					}
	
				}
			}else{
				$data['Subscriber']['status'] = 'inactive';
				if($this->Subscriber->save($data)){
					//mail goes here
					$data['status'] = $varificatin;
					$this->sendEmail($data);
					$reponse['status'] = 'success';
					$reponse['message'] = 'Successfull subscription';
				}
			}
	
		}else{
			$reponse['status'] = 'error';
			$reponse['message'] = 'Network Error, Please Try Again.';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('subscriptionInfo'=>$reponse),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	public function alter_subscription_status(){
		$response = array();
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			//pr($postData);
			$subscriberData = $this->Subscriber->find(
				'first',
				array(
					'fields'=>array('id','email','token'),
					'conditions'=>array('token'=>$postData['params']['token']
					)
				)
			);
			//die();
			if(count($subscriberData) > 0){
				$data['Subscriber']['id'] = $subscriberData['Subscriber']['id'];
				if($postData['params']['status'] == 'verification'){
					$data['Subscriber']['status'] = 'active';
					if($this->Subscriber->save($data)){
						//update and send mail for unsubscription.
						$mailConfigData['Subscriber']['email'] = $subscriberData['Subscriber']['email'];
						$mailConfigData['Subscriber']['token'] = $subscriberData['Subscriber']['token'];
						$mailConfigData['status'] = 'unsubscribe';
						$this->sendEmail($mailConfigData);
						$response['status'] = 'success';
						$response['message'] = 'You have successfully subscribed.';
					}
				}elseif ($postData['params']['status'] == 'unsubscribe'){
					$data['Subscriber']['status'] = 'inactive';
					$data['Subscriber']['token'] = "NULL";
					if($this->Subscriber->save($data)){
						//only update.
						$response['status'] = 'success';
						$response['message'] = 'You have successfully unsubscribed.';
					}
				}else{
					$response['status'] = 'error';
					$response['message'] = 'Invalid Request.';
				}
			}else{
				//invalid request
				$response['status'] = 'error';
				$response['message'] = 'Invalid Request.';
			}
				
		}else{
			$reponse['status'] = 'error';
			$reponse['message'] = 'Network Error, Please Try Again.';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('subscriptionInfo'=>$response),
				'_jsonp' => true
			)
		);
		$this->render('data_layout');
	}
	
	private function sendEmail($dataArray){
		$siteSettingData = $this->SiteSetting->getSiteSettingId();
		$dataArray['SiteSetting'] = $siteSettingData['SiteSetting'];
	
		//send email
		$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
		$emailConfig['from_name'] = $siteSettingData['SiteSetting']['company_name'];
		$emailConfig['to'] = $dataArray['Subscriber']['email'];
		$emailConfig['subject'] = 'Subscription';
		$emailConfig['template'] = 'subscription';
		$emailConfig['data'] = $dataArray;
		$this->EmailSender->sendEmail($emailConfig);
	}
	
	public function beforeRender(){
		parent::beforeRender();
		$this->response->header('Access-Control-Allow-Origin', '*');
	}
}