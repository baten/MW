<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
App::import('Vendor', 'Spreadsheet_Excel_Reader', array('file' => 'excelreader/excel_reader2.php'));
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Uploader');
	
	public $uses = array('Ecommerce.Product','Ecommerce.Category','Ecommerce.Attribute','Ecommerce.Brand','Ecommerce.Team','Ecommerce.RelatedProduct','Ecommerce.ProductImage','Ecommerce.ProductStock');
	
	var $unitArray = array(
			'pcs' => 'pcs',
			'kg' => 'kg',
			'gm' => 'gm',
			'liter' => 'liter',
			'ml' => 'ml',
			'each'=> 'each'
		);
	 
	public $productArr=array();
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('unit',$this->unitArrayBn);
		if($this->langsName == 'English'){
			$this->Product->tablePrefix = 'english_';
			$this->Category->tablePrefix = 'english_';
			$this->Category->tablePrefix = 'english_';
			$this->Team->tablePrefix = 'english_';
			$this->Brand->tablePrefix = 'english_';
			//$this->Sport->tablePrefix = 'english_';
			$this->Attribute->AttributeValue->tablePrefix = 'english_';
			$this->Product->Merchant->tablePrefix = 'english_';
			$this->Product->langsName = 'English';
		}else{
			$this->Product->langsName = 'Bengali';
		}
		$this->set('unit',$this->unitArray);
		
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive = 1;
        $this->paginate = array('order'=>array('Product.created'=>'DESC'));
		if ($this->request->is('post')) {
			$searchText = addslashes($this->request->data['Product']['keywords']);
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Product.title LIKE '%".$searchText."%'",
						"Product.product_code LIKE '%".$searchText."%'",
						"Product.status LIKE '%".$searchText."%'",
						"Product.sku LIKE '%".$searchText."%'",
					)
				),
			 	'contain'=>array('ProductImage'=> array('order'=>array('order'=>'ASC'),'limit' => '1')) 
			);
		}else{
			$this->paginate = array(
				'contain'=>array('ProductImage' => array('order'=>array('order'=>'ASC'),'limit' => '1')),
				'order'=>array('created' => 'DESC')
			);
		}
		$this->set('products', $this->Paginator->paginate());
	}
	
	/**
	 * admin_category_products method
	 *
	 * @return void
	 */
	public function admin_category_products($categoryId) {
	
		$this->Product->recursive = 1;
	
		$this->paginate = array('order'=>array('Product.created'=>'DESC'));
	
		if ($this->request->is('post')) {
			$searchText = addslashes($this->request->data['Product']['keywords']);
			$this->paginate = array(
				'contain'=>array(
					'Product' => array(
						'ProductImage'=>array('order' => array('order' => 'ASC'),'limit' => 1),
						'conditions'=>array(
							'OR'=>array(
								"Product.title LIKE '%".$searchText."%'",
								"Product.product_code LIKE '%".$searchText."%'",
								"Product.status LIKE '%".$searchText."%'",
							)
						),
					)
				),
				'conditions' => array('category_id' => $categoryId),
				'order'=>array('created' => 'DESC')
			);
		}else{
			$this->paginate = array(
				'order'=>array('created' => 'DESC'),
				'contain'=>array(
					'Product' => array('ProductImage'=>array('order' => array('order' => 'ASC'),'limit' => 1))
				),
				'conditions' => array('category_id' => $categoryId)
			);
		}
	
	
		$this->set('products', $this->Paginator->paginate('ProductCategory'));
	}
	
	public function admin_stockreport() {
		$this->Product->recursive = 1;
	 
		if ($this->request->is('post')) {
			$this->paginate = array(
				'fields'=>array('Product.id','Product.title'),
				'conditions'=>array(
					'OR'=>array(
						"Product.title LIKE '%".$this->request->data['ProductStock']['keywords']."%'",
						"Product.product_code LIKE '%".$this->request->data['ProductStock']['keywords']."%'",
					)
				),
				'order'=>array('created' => 'DESC'),
				'contain'=>array('Stock','Sale')
			);
		}else{
			$this->paginate = array(
				'fields'=>array('Product.id','Product.title'),
				'order'=>array('Product.created'=>'DESC'),
				'contain'=>array('Stock','Sale')
			);
	
		}
	
		$this->set('products', $this->Paginator->paginate());
	}
	
	public function admin_salereport() {
		$this->Product->recursive = 0;
	
		if ($this->request->is('post')) {
			$this->paginate = array(
				'fields'=>array('Product.id','Product.title'),
				'conditions'=>array(
					'OR'=>array(
						"Product.title LIKE '%".$this->request->data['ProductSale']['keywords']."%'",
						"Product.product_code LIKE '%".$this->request->data['ProductSale']['keywords']."%'",
					)
				),
				'order'=>array('created' => 'DESC'),
				'contain'=>array('Stock','Sale')
			);
		}else{
			$this->paginate = array(
				'fields'=>array('Product.id','Product.title'),
				'order'=>array('Product.created'=>'DESC'),
				'contain'=>array('Stock','Sale')
			);
	
		}
	
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			unset($data['discount']);
			$data['Product']['slug'] = $this->Product->generateSlug(trim($data['Product']['title']),$this->langsName);
			if(empty($data['Product']['sale_price'])){
				$data['Product']['sale_price'] = $data['Product']['price'];
			}else{
				$data['Product']['options'] = $data['Product']['price'] - $data['Product']['sale_price'] ;
			}
			
			if(!empty($data['Product']['quantity'])){
				$stockData['ProductStock']['quantity']= $data['Product']['quantity'];
			}else{
				$data['Product']['quantity'] = 0;
				$stockData['ProductStock']['quantity']= 0;
			}
			
			if(empty($data['Product']['opening_price'])){
				$data['Product']['opening_price'] = 0;
			} 
			//remove uncheck categories
			if(isset($data['Product']['ProductCategory'])){
				foreach($data['Product']['ProductCategory'] as $category_ind => $category_val){
					if($category_val['category_id'] == 0){
						unset($data['Product']['ProductCategory'][$category_ind]);
					}
				}
			}
			if(isset($data['Product']['RelatedProduct']['related_product'])){
				foreach($data['Product']['RelatedProduct']['related_product'] as $key => $related_product_data){
					$data['Product']['RelatedProduct'][$key]['related_product']= $related_product_data;
				}
				unset($data['Product']['RelatedProduct']['related_product']);
			}
			
			//store image data
			if(isset($data['Product']['ProductImage'])){
				$temp_images = $data['Product']['ProductImage'];
				unset($data['Product']['ProductImage']);
			}

			$ordering = 1;
            if($temp_images){
                foreach ($temp_images as $key=>$value){
                    $data['Product']['ProductImage'][$key]['extension'] =$this->Uploader->getFileExtension($value);
                    $data['Product']['ProductImage'][$key]['order'] = $ordering++;
                }
            }          	
            $this->Product->create();
         //pr($data);die();
            $datasource = $this->Product->getDataSource();
            try {
            	$datasource->begin();
            	if(!$this->Product->saveAssociated($data,array('deep' => true))){
            		throw new Exception();
            	}
            	$product_id = $this->Product->id;

            	//(mipellim) for inserting default stock in product_stocks table 
            	//===block start===
            	$stockData['ProductStock']['product_id']=$product_id;
            	$this->ProductStock->create();
            	$this->ProductStock->save($stockData);
            	//===block end===

            	$image_names =$this->ProductImage->find(
            		'list',
            		array(
            			'fields'=>array('id','extension'),
            			'conditions'=>array('product_id'=>$product_id),
						'order' => array('order'=>'ASC')
            		)
            	);
            	$i = 0;
            	foreach($image_names as $image_name=>$img_extension){
            		if($img_extension == 'zip') {
            			$this->Uploader->upload($temp_images[$i], $image_name, $img_extension, 'products', $fileOrImage = 2);
            		}else {
            			$this->Uploader->upload($temp_images[$i], $image_name, $img_extension, 'products', $fileOrImage = null, $height = '', $width = '', $oldfile = null);
            		}
            		$i++;
            	}
            	//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Product->tablePrefix = 'english_';
				}else{
					$this->Product->tablePrefix = '';
				}  
				$data['Product']['id'] = $product_id;
				if(!$this->Product->save($data)){
					throw new Exception();
				} 		
            		
            	$datasource->commit();
            	$this->Session->setFlash('The product has been saved.','default',array('class'=>'alert alert-success'));
            } catch(Exception $e) {
            	$datasource->rollback();
            	$this->Session->setFlash('The product could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
            }
            
            return $this->redirect(array('action' => 'index')); 
            
			 
		}
		$this->set('productList',$this->Product->find('list'));
		$this->set('catNode',$this->getCategotriesWithNode());
		$this->set('productBrands', $this->getProductBrands());
		$this->set('productSports', $this->getProductSport());
		$this->set('merchants',$this->Product->Merchant->find('list'));
		$this->set('teams',$this->Product->Team->find('list'));
		$this->set('attributes',$this->Attribute->getAttributes());
	}


	private function getCategotriesWithNode(){
		$data = $this->Category->find(
				'threaded',
				array(
						'contain' => array(),
						'fields' => array('id','parent_id', 'title'),
						'conditions'=>array('status'=>'active')
						
				)
		);
		
		return $data;
	}

	//get all brand list
	private function getProductBrands(){
		$data = $this->Brand->find('list');
		return $data;
	}
	
	//get all brand list
	private function getProductSport(){
		//$data = $this->Sport->find('list');
		//return $data;
	}
/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {	
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		 
		if ($this->request->is(array('post', 'put'))) {
			
			$data = $this->request->data;
			//$data['Product']['slug'] = $this->Product->generateSlug(trim($data['Product']['title']),$this->langsName,$id);
			////remove uncheck brands
			if(isset($data['Product']['ProductBrand'])){
				foreach($data['Product']['ProductBrand'] as $brand_ind => $brand_val){
					if($brand_val['brand_id'] == 0){
						unset($data['Product']['ProductBrand'][$brand_ind]);
					}
				}
			}	
			
			////remove uncheck sports
			if(isset($data['Product']['ProductSport'])){
				foreach($data['Product']['ProductSport'] as $sport_ind => $sport_val){
					if($sport_val['sport_id'] == 0){
						unset($data['Product']['ProductSport'][$sport_ind]);
					}
				}
			}
			//pr($data);die();
			$updateableDataForOpposite = array();
			$updateableDataForOpposite['Product']['team_id'] = $data['Product']['team_id'];
			if(!empty($data['Product']['price'])){
				$updateableDataForOpposite['Product']['price'] = $data['Product']['price'];
			}
			
			
			if($data['Product']['sale_price'] > 0){
				$updateableDataForOpposite['Product']['sale_price'] = $data['Product']['sale_price'];
				$data['Product']['sale_price'] = $data['Product']['sale_price'];
				$data['Product']['options'] = $data['Product']['price'] - $data['Product']['sale_price'];
				$updateableDataForOpposite['Product']['options'] = $data['Product']['options'];
			}else{
				$updateableDataForOpposite['Product']['sale_price'] = $data['Product']['price'];
				$updateableDataForOpposite['Product']['options'] = 0;
				$data['Product']['sale_price'] = $data['Product']['price'];
				$data['Product']['options'] = 0;
			}
			
			if(!empty($data['Product']['sku'])){
				$updateableDataForOpposite['Product']['sku'] = $data['Product']['sku'];
			}else{
				$updateableDataForOpposite['Product']['sku'] = '';
				$data['Product']['sku'] = '';
			}
			
			if(!empty($data['Product']['opening_price'])){
				$updateableDataForOpposite['Product']['opening_price'] = $data['Product']['opening_price'];
			}
		 
			
			
			//remove uncheck categories
			if(isset($data['Product']['ProductCategory'])){
				foreach($data['Product']['ProductCategory'] as $category_ind => $category_val){
					if($category_val['category_id'] == 0){
						unset($data['Product']['ProductCategory'][$category_ind]);
					}
				}
			}
			
			if(isset($data['Product']['RelatedProduct']['related_product'])){
				foreach($data['Product']['RelatedProduct']['related_product'] as $key => $related_product_data){
					$data['Product']['RelatedProduct'][$key]['related_product']= $related_product_data;
				}
				unset($data['Product']['RelatedProduct']['related_product']);
			}
			//store images temporary.
			if(isset($data['Product']['ProductImage'])){
				$submitted_images = $data['Product']['ProductImage'];
				unset($data['Product']['ProductImage']);
				$temp_images = array();
				$ordering = 1;
				foreach($submitted_images as $temp_img_no => $temp_img_val){
					if(isset($temp_img_val['id_extension'])){
						$temp_image_id_extension_array = explode('#ZUBAYER#', $temp_img_val['id_extension']);
						$temp_img_val['id'] = $temp_image_id_extension_array[0];
						$temp_img_val['extension'] = $temp_image_id_extension_array[1];
						unset($temp_img_val['id_extension']);
					}
					$temp_img_val['order'] = $ordering++;
					$temp_images[$temp_img_no] = $temp_img_val;
				}
			}
			//pr($data);die();
			$datasource = $this->Product->getDataSource();
			try {
				$datasource->begin();
				if (!$this->Product->deleteAll(array('Product.id'=>$id,true))) {
					throw new Exception();
				}
				
				$data['Product']['id']= $id;
				$this->Product->create();
				if (!$this->Product->saveAssociated($data,array('deep' => true))) {
					throw new Exception();
				}
				
				$slugData = $this->Product->findById($id,array('Product.slug'));
				//$product_id = $this->Product->getInsertID();
				$product_id = $id;
					
				if($this->langsName == 'Bengali'){
					$engSlugData = $this->Product->query("SELECT slug FROM english_products WHERE id='".$product_id."'");
					$this->Product->id = $product_id;
					$this->Product->saveField('slug', $engSlugData[0]['english_products']['slug']);
					$this->Product->tablePrefix = 'english_';
				}else{
					$this->Product->tablePrefix = '';
					$updateableDataForOpposite['Product']['slug'] = $slugData['Product']['slug'];
				}
				$this->Product->updateData('Product', $updateableDataForOpposite, $product_id, $this->Product->tablePrefix);
				
				if(!empty($temp_images)) {
					$this->update_images($product_id, $temp_images);
				}
				$datasource->commit();
				$this->Session->setFlash('The product has been updated.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}catch(Exception $e) {
            	$datasource->rollback();
            	$this->Session->setFlash('The product could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
            }
			
		} else {
			$options = array(
				'conditions' => array(
					'Product.' . $this->Product->primaryKey => $id
				),
				'contain' => array(
					'ProductCategory',
					'ProductBrand',
					'ProductSport',					
					'ProductImage' =>array('order'=>array('order' => 'ASC')),
					'Merchant',
					'RelatedProduct',
					'ProductAttribute' => array('ProductAttributeValue')
				)
			);
			
			$getCurrentDetails  = $this->Product->find('first', $options);			
			
			$request_data =  $getCurrentDetails; //$this->Product->find('first', $options);	
			//brands list
			$selected_Brands = array();
			foreach($request_data['ProductBrand'] as $key=>$value ){
				$selected_Brands[] = $value['brand_id'];
			}
			//sports list
			$selected_Sports = array();
			foreach($request_data['ProductSport'] as $key=>$value ){
				$selected_Sports[] = $value['sport_id'];
			}
				
			//category list
			//related products list
			$selected_related_products = array();
			foreach($request_data['RelatedProduct'] as $key=>$value ){
				$selected_related_products[] = $value['related_product'];
			}
				
			$request_data['RelatedProduct'] = $selected_related_products;
			
			$selected_Categories = array();
			foreach($request_data['ProductCategory'] as $key=>$value ){
				$selected_Categories[] = $value['category_id'];
			}
			 
			$request_data['ProductCategory'] = $selected_Categories;
			$request_data['ProductBrand'] = $selected_Brands;
			$request_data['ProductSport'] = $selected_Sports;
			
			//pr($request_data);
			$this->request->data = $request_data;
		}
		//pr($request_data);die();
		$this->set('productList',$this->Product->find('list',array('conditions'=>array('NOT'=>array('Product.id'=>$id)))));
		$this->set('catNode',$this->getCategotriesWithNode());	
		$this->set('productBrands', $this->getProductBrands());
		$this->set('productSports', $this->getProductSport());
		$this->set('merchants',$this->Product->Merchant->find('list'));
		$this->set('attributes',$this->Attribute->getAttributes());
		$this->set('teams',$this->Product->Team->find('list'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		$deleteable_image_files = $this->Product->ProductImage->find('list',array('fields'=>array('id','extension'), 'conditions'=>array('product_id'=> $id)));
		
		$datasource = $this->Product->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Product->deleteAll(array('Product.id'=>$id,true))){
				throw new Exception();
			}
			
			 
			if($this->langsName=='Bengali'){
				$this->Product->tablePrefix = 'english_';
			}else{
				$this->Product->tablePrefix = '';
			}
			$this->Product->id = $id;
			if(!$this->Product->delete()){
				throw new Exception();
			}
			foreach($deleteable_image_files as $id=>$ext){
				$this->Uploader->deleteFile(WWW_ROOT."img/site/products/{$id}.{$ext}");
			}
			$datasource->commit();
			$this->Session->setFlash('The Product has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The Product could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		} 
	 
		return $this->redirect(array('action' => 'index'));
	}



    public function admin_product_settings($id = null) {
        if ($this->request->is(array('post', 'put'))) {
            $data=$this->request->data;
          // pr($data);die();
            //$this->Product->updateData('Product', $data, $id, 'english_');
           // $this->Product->updateData('Product', $data, $id, '');
           $purchased = $data['Product']['purchased'];
           $this->Product->query("UPDATE products SET price='".$data['Product']['price']."',sale_price='".$data['Product']['sale_price']."',purchased=(purchased + $purchased) WHERE id='".$id."'");
           $this->Product->query("UPDATE english_products SET price='".$data['Product']['price']."',sale_price='".$data['Product']['sale_price']."',purchased=(purchased + $purchased) WHERE id='".$id."'");

            $this->Session->setFlash('The Product settings has been saved.','default',array('class'=>'alert alert-success'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $product= $this->Product->find('first', $options);

        }
        $this->set('product',$product);



    }

	
	// 
	protected function update_images($product_id, $image_files){
		$final_images['ProductImage'] = array();
		
		$totaly_newly_added = array();
		foreach($image_files as $n_k=>$n_v){
			if($n_v['error'] == 0 and !isset($n_v['id'])){
				$totaly_newly_added[$n_k] = $n_v;
				
				$temp_image = array();
				$temp_image['product_id'] = $product_id;
				$temp_image['extension'] = $this->Uploader->getFileExtension($n_v);
				$temp_image['order'] = $n_v['order'];
				$temp_image['file'] = $n_v;
				
				array_push($final_images['ProductImage'],$temp_image);
			}
		}
		
		//file updated images
		$file_updated_only = array();
		foreach($image_files as $u_f_k=>$u_f_v){
			if($u_f_v['error'] == 0 and isset($u_f_v['id'])){
				$file_updated_only[$u_f_k] = $u_f_v;
				$this->Uploader->deleteFile(WWW_ROOT."img/site/products/{$u_f_v['id']}.{$u_f_v['extension']}");
				unset($u_f_v['id']);
				unset($u_f_v['extension']);
				
				$temp_image = array();
				$temp_image['product_id'] = $product_id;
				$temp_image['extension'] = $this->Uploader->getFileExtension($u_f_v);
				$temp_image['order'] = $u_f_v['order'];
				$temp_image['file'] = $u_f_v;
				
				array_push($final_images['ProductImage'],$temp_image);
				
			}
		}
		
		
		// existing images 
		$existing_images = array();
		foreach($image_files as $ex_k=>$ex_v){
			if($ex_v['error'] != 0 and isset($ex_v['id'])){
				
				$temp_image = array();
				$temp_image['product_id'] = $product_id;
				$temp_image['extension'] = $ex_v['extension'];
				$temp_image['order'] = $ex_v['order'];
				$temp_image['renaming_id'] = $ex_v['id'];
				
				array_push($final_images['ProductImage'],$temp_image);
			}
		}
		
		
		//update db and databases
		foreach($final_images['ProductImage'] as $i => $data){
			
			$saving_data['ProductImage'] = $data;
			
			$this->Product->ProductImage->create();
			if($this->Product->ProductImage->save($data)){
				
				$image_id = $this->Product->ProductImage->getInsertId();
				if(isset($data['file'])){
					$this->Uploader->upload($data['file'], $image_id, $data['extension'], 'products',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				}elseif(isset($data['renaming_id'])){
					
					$old_name = WWW_ROOT."img/site/products/{$data['renaming_id']}.{$data['extension']}";
					$new_name = WWW_ROOT."img/site/products/{$image_id}.{$data['extension']}";
					rename($old_name, $new_name);
				}
			}
		}
		
	}
	
	//delete productimage by id
	public function admin_delete_product_image_by_id(){
		$this->layout = false;
		$this->autoRender = false;
		if($this->request->is('Post')){
			$file_name = $this->request->data['image_id'];
			$image_array = explode('.',$file_name);
			if($this->Product->ProductImage->delete($image_array[0])){
				$this->Uploader->deleteFile(WWW_ROOT."img/site/products/{$file_name}");
				return 'success';
			}else{
				return 'fail';
			}
		}
		
	}
	
	//product data insert from excel file
	public function admin_excelImport() {
			 
		$merchantList = $this->Product->Merchant->find('list',array('fields' => array('id','fullName')));
		$teamList = $this->Product->Team->find('list',array('fields' => array('id','title')));
	
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$file=$data['Product']['file'];
			$fileName=$file['name'];
			$filePath=$file['tmp_name'];
			$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
			//for .xlsx 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			if(($file['error'] === 0) && ($file['type'] === 'application/vnd.ms-excel' || $fileExtension == 'xls')){
				$data = new Spreadsheet_Excel_Reader($filePath, true);
				$data->setOutputEncoding('UTF-8');
				$prodcutFromExcel = $data->dumptoarray();				
				$insertedIds = array();
				//$datasource = $this->Product->getDataSource();
				try {
					foreach ($prodcutFromExcel as  $key=>$value) {
						$team = $merchant = '';
						if(!empty(array_search(trim($value['merchant']),$merchantList))){
							$merchant = array_search(trim($value['merchant']),$merchantList);
						}
							
						if(!empty(array_search(trim($value['team']),$teamList))){
							$team = array_search(trim($value['team']),$teamList);
						}
						//pr($value);
						$title=trim($value['title']);

						$sale_price=(float) $value['sale_price'];
						$base_price=(float) $value['base_price'];

						if($sale_price == 0 ){
							$sale_price=$base_price;
							$options=0;
						}else{
							$options=$base_price-$sale_price;
						}

						
														
						//$this->productArr[]
						$this->productArr=[
							"title"					=> 	$title,
							"slug"					=>	$this->Product->generateSlug($title,$this->langsName),
							"merchant_id"			=>	$merchant,
							"team_id"				=>	$team,
							"product_code"			=>	$value['product_code'],
							"sku"					=>	$value['sku'],
							"meta_keys"				=>	$value['meta_keys'],
							"meta_description"		=>	$value['meta_description'],
							"description"			=>	$value['description'],
							"price"					=>  $base_price,
							"opening_price"			=>  $base_price,
							"sale_price"			=>  $sale_price,
							"options"				=>  $options,
							"status"				=>	$value['status'],
							"quantity"				=> (int) $value['quantity'],
							"purchased"				=> (int) $value['quantity']
						];					
						
						$this->Product->create();
						if($this->Product->save($this->productArr)){
							$insertedIds [] = $this->Product->id;

							//(mipellim) for inserting default stock in product_stocks table 
							$stockDataArr[]['ProductStock']['product_id']=$this->Product->id;
	            			//end
						}
						 
					}
				

					$newData = $this->Product->find('all',array('recursive'=>-1,'conditions'=>array('id'=>$insertedIds)));

					//(mipellim) for inserting default stock in product_stocks table 
	            	//===block start===	
	            	//pr($stockDataArr);die();
	            	$this->ProductStock->create();
	            	$this->ProductStock->saveMany($stockDataArr);
	            	//===block end===

					$newData2 = Set::extract('/Product/.', $newData);
					// pr($newData2);
					//save data in oposite table
					if($this->langsName=='Bengali'){
						$this->Product->tablePrefix = 'english_';
					}else{
						$this->Product->tablePrefix = '';
					}
					
					if(!$this->Product->saveMany($newData2)){
						throw new Exception();
					}

					//$datasource->commit();
					return $this->redirect(array('action' => 'index'));
				}catch(Exception $e) {
					$datasource->rollback();
					$this->Session->setFlash('The product could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
				}		
				
				 
			}else{
				$this->Session->setFlash("{$fileName} is not readable. Please, try again.",'default',array('class'=>'alert alert-warning'));
				return $this->redirect(array('action' => 'add'));
			}
			 
		}
	
	}
	 
	
	/**
	 * Ajax post for States
	 */
	public function admin_ajax_getStates(){
		
		$this->autoRender = false;
		$data = ClassRegistry::init('Shipping.State')->getStates($_REQUEST['countryId']);
	
		return json_encode($data,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
}
