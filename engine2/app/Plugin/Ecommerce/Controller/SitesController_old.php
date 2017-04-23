<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');


/**
 * Brands Controller
 *
 * @property Brand $Brand
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SitesController extends EcommerceAppController {

	//merchantid = 25227
	//r8MRx39ZzNw6m5PEs7b4DYa67CtFf8d3WGj45Key

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('RequestHandler','Ecommerce.Icepay');

	public $uses = array(
			'Ecommerce.Category',
			'Ecommerce.Brand',
			'Ecommerce.Product',
			'Ecommerce.Store',
			'Ecommerce.Type',
			'Ecommerce.Attribute',
			'Ecommerce.ProductOrder',
			'Ecommerce.Store',
			'Ecommerce.TypeCategory'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function beforeRender(){
		$this->response->header('Access-Control-Allow-Origin', '*');
	}


	/*
	 * barnd list
	*/
	public function brand_list(){
		if($this->request->is('get')){
			$data = $this->Brand->find('list',array('conditions'=>array('status'=>'active')));
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceBrands'=>$data),
							'_jsonp' => true
								
					)
			);
		}else{
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceBrands'=>'Invalid Request'),
							'_jsonp' => true
					)
			);
		}
		$this->render('json_render');
	}

	public function brand_list_image(){
		if($this->request->is('get')){
			$data = $this->Brand->find(
					'all',
					array(
							'conditions'=>array(
									'status'=>'active',
									'image_extension !=' => ''
							),
							'fields' => array(
									'id','image_extension','title'
							),
							'recursive' => -1
					)
			);
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceBrands'=>$data),
							'_jsonp' => true

					)
			);
		}else{
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceBrands'=>'Invalid Request'),
							'_jsonp' => true
					)
			);
		}
		$this->render('json_render');
	}




	/*
	 * category list
	*/
	public function category_list(){
		if($this->request->is('get')){
			$data = $this->Category->find('list',array('conditions'=>array('status'=>'active')));
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceCategories'=>$data),
							'_jsonp' => true
					)
			);
		}else{
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceCategories'=>'Invalid Request'),
							'_jsonp' => true
					)
			);
		}

		$this->render('json_render');
	}


	/**
	 * get random product list
	 */
	public function random_product_list(){
		if($this->request->is('POST')){
			$postData = $this->request->data;
			if(isset($postData['pageNo'])){
				$page = $postData['pageNo'];
			}else{
				$page = 1;
			}
			$limit = 20;
			
			$data = $this->Product->find(
					'all',
					array(
							'conditions' => array('status' => 'active'),
							'order'		 => array('created'=> 'asc'),
							'limit'		 => $limit,
							'page'		 => $page
					)
			);
			
			$productList = array();
			foreach($data as $key=>$val){
				$checkData = json_decode($val['Product']['options'],true);
				$val['Product']['options'] = $checkData;
				array_push($productList, $val);
			}
			
			$noOfProducts = $this->Product->find('count');
			$pageNo = $this->paginationCalculator($noOfProducts,$limit);
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceProductList'=>$productList,'paginagtion'=>$pageNo),
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

		$this->render('json_render');
	}

	/*pagination*/
	private function paginationCalculator($count,$limit){
		$extraPage = $count%$limit;
		$defaultPage = ($count -  ($count%$limit))/$limit;
		if($extraPage > 0){
			$noOfPage = $defaultPage + 1;
		}else{
			$noOfPage = $defaultPage;
		}
		
		$pages = array();
		for($i = 1; $i<= $noOfPage; $i++){
			$pages[$i] = $i;
		}
		
		return $pages;
	}

	/**
	 * product_list_by_category
	 */
	public function product_list_by_category($id){
		$data = $this->Product->find(
				'all',
				array(
						'contain' => array(
								'ProductCategory' => array(
										'conditions'	=> array(
												'ProductCategory.category_id'=> $id,
										)
											
								),
								'ProductImage'
						),
						'conditions' => array(
								'Product.status' => 'active'
						),
						'order' => array('modified' => 'asc')

				)
		);

		//sort out by cat
		foreach($data as $key=>$val){
			if(sizeof($val['ProductCategory'])<= 0){
				unset($data[$key]);
			}
		}


		$this->set(
				array(
						'_serialize',
						'data' => array('ecommerceProductList'=>$data),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}



	/**
	 * product_list_by_brand
	 */
	public function product_list_by_brand($id){
		$data = $this->Product->find(
				'all',
				array(
						'contain' => array(
								'ProductBrand'=> array(
										'conditions' => array(
												'ProductBrand.brand_id' => $id
										)
								),
								'ProductImage'
						),
						'conditions'	=> array(
								'Product.status' 		=> 'active',
						),
						'order' => array('modified' => 'asc')
				)
		);

		//sort out by cat
		foreach($data as $key=>$val){
			if(sizeof($val['ProductBrand'])<= 0){
				unset($data[$key]);
			}
		}
		$this->set(
				array(
						'_serialize',
						'data' => array('ecommerceProductList'=>$data),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}

	/**
	 * product_details_by_id
	 */
	public function product_details(){
		$postData = $this->request->data;

		$data = $this->Product->find(
				'all',
				array(
						'contain' => array(
							'ProductBrand',
							'ProductCategory',
							'ProductImage',
							'ProductAttribute' => array(
									'ProductAttributeValue'
							),
							'RelatedProduct'
						),
						'conditions'	=> array(
								'Product.id' 		=> $postData['productId'],
								'Product.status' 	=> 'active',
						)
				)
		);
		$data[0]['Product']['options'] = json_decode($data[0]['Product']['options'],true);
		
		$relatedProducts =  $this->Product->find(
			'all',
			array(
				'fields' => array(
					'id','title','product_code','price'	
				),
				'contain' => 'ProductImage'		
			)		
		);
		
		
		$relatedProductsList = array();
		foreach($data[0]['RelatedProduct'] as $k=>$v){
			$realtedProductId = $v['related_product'];
			foreach($relatedProducts as $r_k => $r_v){
				if($r_v['Product']['id'] == $realtedProductId){
					array_push($relatedProductsList, $r_v);
				}
			}
		}
		$data[0]['RelatedProduct'] = $relatedProductsList;
	
		$this->set(
				array(
						'_serialize',
						'data' => array('ecommerceProductDetails'=>$data),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}

	/**
	 * product_attribute_list
	 */
	public function product_attribute_list(){
		$postData = $this->request->data;
		$data = $this->Attribute->find('all',array('conditions'=> array('Attribute.type_id'=> $postData['type_id'])));
		$this->set(
				array(
						'_serialize',
						'data' => array('ecommerceProductAttributes'=>$data),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}

	/**
	 * checkout
	 */
	public function order(){
		if($this->request->is('post')){
			$post_data =  $this->request->data;
				
				
			$ready_data['ProductOrder']['client_detail'] 	= json_encode($post_data['client_details']);
			$ready_data['ProductOrder']['order_detail'] 	= json_encode($post_data['cart']);
			$ready_data['ProductOrder']['shipping_detail']	= json_encode($post_data['shipping_detail']);
			$ready_data['ProductOrder']['status'] 			= 'ordered';
				
				
			if($this->ProductOrder->save($ready_data)){
				$order_id = $this->ProductOrder->getInsertId();
				$icePayData['amount'] = $post_data['total_cost']*100;
				$icePayData['order_id'] = $order_id;

				$payment_object = $this->Icepay->processPaymentObject($icePayData);

				$payment_url = $this->Icepay->getPayNowUrl($payment_object,$order_id);
				$response['status'] = true;
				$response['message'] = $payment_url;
			}else{
				$response['status'] = false;
				$response['message'] = 'Please try again';
			}
				
			//paymentDetail
				
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
		$this->render('json_render');

	}

	/*
	 * shoping history
	*/

	public function shoping_history(){

		if($this->request->is('post')){
			$post_data =  $this->request->data;//$this->request->input('json_decode',true);
			$client_data = json_decode($post_data['client_details'],true);
			$client_id = $client_data['Client']['id'];
				
			//ordered
			$data_ordered = $this->ProductOrder->find(
					'all',
					array(
							'conditions' => array(
									'client_detail LIKE' => "%$client_id%",
									'status' => 'ordered'
							),
							'recursive'=>-1
					)
			);
				
			//processing
			$data_processing = $this->ProductOrder->find(
					'all',
					array(
							'conditions' => array(
									'client_detail LIKE' => "%$client_id%",
									'status' => 'processing'
							),
							'recursive'=>-1
					)
			);
				
			//completed
			$data_completed = $this->ProductOrder->find(
					'all',
					array(
							'conditions' => array(
									'client_detail LIKE' => "%$client_id%",
									'status' => 'completed'
							),
							'recursive'=>-1
					)
			);
				
			$data_cancelled = $this->ProductOrder->find(
					'all',
					array(
							'conditions' => array(
									'client_detail LIKE' => "%$client_id%",
									'status' => 'cancelled'
							),
							'recursive'=>-1
					)
			);
				
			$response['ordered'] = $data_ordered;
			$response['processing'] = $data_processing;
			$response['completed'] = $data_completed;
			$response['cancelled'] = $data_cancelled;
				
				
		}else{
			$response = array('message'=>'Invalid Request');
		}

		$this->set(
				array(
						'_serialize',
						'data' => array('ecommerceHistory'=>$response),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}


	public function payNow(){
		$response = $this->Icepay->payByIcePay();
		$this->set(
				array(
						'_serialize',
						'data' => array('ecommerceHistory'=>$response),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}

	public function payment_methods(){
		$payment_methods  = $this->Icepay->getPaymentMethods();

		$payment_methods_data = array();
		foreach($payment_methods as $k=>$v){
			$payment_methods_data[$v['PaymentMethodCode']] = $v['Description'];
		}

		$this->set(
				array(
						'_serialize',
						'data' => array('ecommercePaymentMethods'=>$payment_methods_data),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}

	/*
	 public function brandTree(){
	if($this->request->is('get')){
	$data = $this->Brand->find('all',array('conditions'=>array('status'=>'active')));
	$this->set(
			array(
					'_serialize',
					'data' => array('ecommerceBrands'=>$data),
					'_jsonp' => true

			)
	);
	}else{
	$this->set(
			array(
					'_serialize',
					'data' => array('ecommerceBrands'=>'Invalid Request'),
					'_jsonp' => true
			)
	);
	}
	$this->render('json_render');
	}

	*/

	public function getStores(){
		if($this->request->is('get')){
			$data = $this->Store->find('all',array('conditions'=>array('status'=>'active'),'order' =>  array('order'=>'asc')));
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceStores'=>$data),
							'_jsonp' => true
					)
			);
		}else{
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceStores'=>'Invalid Request'),
							'_jsonp' => true
					)
			);
		}
		$this->render('json_render');
	}

	public function getAttrByCatId(){
		if($this->request->is('post')){
			$postData = $this->request->data;
			$typeId = $this->TypeCategory->find('first',
					array(
							'conditions'=>array(
									'category_id'=>$postData['catId']
							),
							'fields' => array('type_id'),
							'recursive' => -1
					)
			);
			//get all attributes by type
			if(isset($typeId['TypeCategory']['type_id'])){
				$attList = $this->Attribute->find(
						'all',
						array(
								'contain' => array(
										'AttributeValue' => array(
												'fields' => array(
														'value',
														'id'
												)
										)
								),
								'conditions' => array(
										'Attribute.type_id' =>	$typeId['TypeCategory']['type_id']
								),
								'fields' => array('title')
						)
				);
			}else{
				$attList = '';
			}
				
			$response['status'] = true;
			$response['message'] = $attList;
		}else{
			$response['status'] = false;
			$response['message'] = 'Invalid request type.';
		}

		$this->set(
				array(
						'_serialize',
						'data' => array('attributesForFilter'=>$response),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}

	public function getProductsByAttrFilter(){

		$postData = $this->request->data;
		$request_attr_id = '';
		$request_attr_val_id = '';
		//attr filtes
		foreach(($postData['filterRulesQuery']) as $key=>$value){
			$request_attr_id .= "ProductAttribute.attribute_id = '{$key}' OR ";
				
			foreach($value as $k=>$v){

				$request_attr_val_id .= "ProductAttributeValue.attribute_value_id = '{$v}' OR ";
			}
		}




		$data = $this->Product->find(
				'all',
				array(
						'contain' => array(
								//'ProductBrand',
								'ProductCategory'=>array(
										'conditions' => array(
												'ProductCategory.category_id' => $postData['catId']
										)
								),
								'ProductImage',
								'ProductAttribute'=> array(
										'conditions' => array(
												substr($request_attr_id,0,-4)
										),
										'ProductAttributeValue' => array(
												'conditions' => array(
														substr($request_attr_val_id,0,-4)
												)
										)
								)
						),
						'conditions' => array('status' => 'active'),
						'order'		 => array('created'=> 'asc'),
						'limit'		 => 20
				)
		);

		//filter
		foreach($data as $key=>$value){
			if(sizeOf($value['ProductAttribute']) <= 0){
				unset($data[$key]);
			}else{
				$attrValValStatus = 0;
				foreach($value['ProductAttribute'] as $attr_k=>$attr_v){
					if(sizeof($attr_v['ProductAttributeValue']) > 0){
						$attrValValStatus++;
					}
				}

				if($attrValValStatus == 0){
					unset($data[$key]);
				}
			}
				
			if(isset($data[$key])){
				unset($data[$key]['ProductAttribute']);
			}
		}

		$this->set(
				array(
						'_serialize',
						'data' => array('ecommerceProductList'=>$data),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}

	public function order_update_by_icepay(){
		if($this->request->is('POST')){
			$data = $this->request->data;
				
			$saveData['ProductOrder']['payment_detail'] = json_encode($data['paymentDetails']);
			$saveData['ProductOrder']['payment_status'] = $data['paymentStatus'];
			$this->ProductOrder->id = $data['orderId'];
			if($this->ProductOrder->save($saveData)){
				$response['status'] = true;
				$data = $this->ProductOrder->find(
						'first',
						array(
								'conditions' => array('id' =>$data['orderId'] )
						)
				);
				$responseData['orderId'] =  $data['ProductOrder']['id'];
				$responseData['billingDetails'] =  json_decode(json_decode($data['ProductOrder']['client_detail'],true));
				$responseData['shippingDetails'] =  json_decode($data['ProductOrder']['shipping_detail'],true);
				$responseData['orderDetails'] =  json_decode($data['ProductOrder']['order_detail'],true);
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
		$this->render('json_render');
	}

	public function category_tree(){
		$this->layout = false;
		$this->autoRender = false;
		$data = $this->Category->find(
				'threaded',
				array(
						'contain' => array(),
						'conditions'=>array(
								'status'=>'active'
						),
						//'order' => 'order'
				)
		);
		//array_ma
		$listString = $this->TreeList($data);
		$listArray = explode('#id#',$listString);
		$catTreeList = array();
		for($i=1; $i<sizeof($listArray); $i++){
			$listIndData = explode('#title#', $listArray[$i]);
			$catTreeList[$i]['id'] = $listIndData[0];
			$catTreeList[$i]['title'] = $listIndData[1];
		}
		
		
		$this->set(
				array(
						'_serialize',
						'data' => array('categoryTree'=>$catTreeList),
						'_jsonp' => true
				)
		);


		$this->render('json_render');

	}




	function TreeList($threaded,$level=0,&$html = '') {
		if(sizeof($threaded)>0){
			foreach ($threaded as $key => $node) {
				foreach ($node as $type => $threaded) {
					if ($type !== 'children') {
						$dash_html = '';
						for($i = 1; $i<= $level; $i++){
							$dash_html .= '-';
						}
						 $html .="#id#".$threaded['id']."#title#".$dash_html." ".$threaded['title'];
					} else {
						if (!empty($threaded)) {
							$html .= $this->TreeList($threaded,$level+1);
						}
					}
				}
			}
		}
		return $html;
	}
	
	
 //random deal list
 
	public function random_deal_list(){
		if($this->request->is('Post')){
			$postData = $this->request->data;
			if(isset($postData['pageNo'])){
				$page = $postData['pageNo'];
			}else{
				$page = 1;
			}
			$limit = 20;
				
			$data = $this->Product->find(
					'all',
					array(
						'conditions' => array('status' => 'active'),
						'order'		 => array('created'=> 'asc'),
						'limit'		 => $limit,
						'page'		 => $page
					)
			);
			
			$productList =  array();
			foreach($data as $key=>$val){
				$checkData = json_decode($val['Product']['options'],true);
				if($checkData['discount'][1]['amount'] > 0){
					$val['Product']['options'] = $checkData;
					array_push($productList, $val);
				}
			}
			
			//$noOfProducts = $this->Product->find('count');
			$pageNo = $this->paginationCalculator(sizeof($productList),$limit);
			$this->set(
					array(
							'_serialize',
							'data' => array('ecommerceProductList'=>$productList,'paginagtion'=>$pageNo),
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
	
		$this->render('json_render');
	}
}
