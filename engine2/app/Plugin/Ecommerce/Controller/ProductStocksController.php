<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
App::import('Vendor', 'Spreadsheet_Excel_Reader', array('file' => 'excelreader/excel_reader2.php'));
/**
 * ProductStocks Controller
 *
 * @property ProductStock $ProductStock
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ProductStocksController extends EcommerceAppController {
	
	public $uses = array('Ecommerce.ProductStock','Ecommerce.Attribute','Ecommerce.ProductAttribute','Ecommerce.Product');
	

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');
	
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Attribute->tablePrefix = 'english_';
			$this->Attribute->AttributeValue->tablePrefix = 'english_';
			$this->Attribute->langsName = 'English';
		}else{
			$this->Attribute->langsName = 'Bengali';
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($productId) {
		$this->ProductStock->recursive = -1;
		$productData = $this->Product->getProductById($productId);
		$productData['Product']['id']=$productId;
		$detaultStock = $this->ProductStock->getDetaultStock($productId);
		$this->paginate = array('conditions'=>array('product_id' => $productId));
		$data = $this->getAttribute();
		
		$attributeValues = '';
		foreach($data as $datum){
				if(!empty($datum['AttributeValue'])){
					foreach ($datum['AttributeValue'] as $attValue){
						$attributeValues[$attValue['id']] = $attValue['value'];
					}
				}
		}
		$this->set('productStocks', $this->Paginator->paginate());
		$this->set('attributeValues',$attributeValues);
		$this->set('product',$productData);
		$this->set('detaultStock',$detaultStock);
	}
	

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductStock->exists($id)) {
			throw new NotFoundException(__('Invalid product stock'));
		}
		$options = array('conditions' => array('ProductStock.' . $this->ProductStock->primaryKey => $id));
		$this->set('productStock', $this->ProductStock->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$ajaxRequestData = $this->request->data;
			$productId = $ajaxRequestData['productId'];
			
			//get useCombination attributes
			$data = $this->getAttribute();
			//added attribute value in product-attribute
			$productAttributeValue = $this->ProductAttribute->getProductAttributeValue($productId);
			if(!empty($data)){
				$this->ProductStock->create();
				if(!empty($ajaxRequestData['newEntry'])){
					if(!empty($productAttributeValue)){
						$resultAddedValue = array();
						foreach($productAttributeValue as $attr){
							if(!empty($attr['ProductAttribute'])){
								foreach ($attr['ProductAttributeValue'] as $value){
									$resultAddedValue[$attr['ProductAttribute']['attribute_id']][] = $value['attribute_value_id'];
								}
							}
						}
					}
					$result = array();
					$attributeArr = array();
					foreach($data as $datum){
						if(isset($resultAddedValue[$datum['Attribute']['id']]) AND !empty($resultAddedValue[$datum['Attribute']['id']])){
							if(!empty($datum['AttributeValue'])){
								$attributeArr[]= $datum['Attribute']['id'];
								foreach ($datum['AttributeValue'] as $attValue){
									if(in_array($attValue['id'],$resultAddedValue[$datum['Attribute']['id']])){
										$result[$datum['Attribute']['id']][] = $attValue['id'];
									}
								}
							}
						}
					}
					$newData = $this->generateCombination($result);
					
					$processData = array();
					$attrValues = '';
					$attributes = '';
					$i = 0;
					$attributes = implode(array_values($attributeArr), '|');
					foreach ($newData as $stock){
						$attrValues = implode(array_values($stock), '|');
						$processData[$i]['ProductStock']['product_id']= $productId;
						$processData[$i]['ProductStock']['attributes'] = $attributes;
						$processData[$i]['ProductStock']['attributeValues'] = $attrValues;
						//$processData[$i]['ProductStock']['quantity'] = $quantity;
						$i++;
					}
					//delete all stock data for this product
					$this->ProductStock->query("DELETE FROM product_stocks WHERE product_id = '".$productId."' && attributeValues != ''");
					//add stock under this product
					if($this->ProductStock->saveMany($processData)){
						$response['message'] = "Combination generated successfully";
					}else{
						$response['message'] = "Please try again.";
					}
					
					
				}else{
					$addedStockData = $this->ProductStock->getStockByProductId($productId);
					$addedAttrValueList = array_keys($addedStockData);
					if(!empty($addedStockData)){
						$addedAttributeArr = explode('|', reset($addedStockData));
						if(!empty($productAttributeValue)){
							$resultAddedAttrValue = array();
							foreach($productAttributeValue as $attr){
								if(in_array($attr['ProductAttribute']['attribute_id'], $addedAttributeArr)){
									if(!empty($attr['ProductAttribute'])){
										foreach ($attr['ProductAttributeValue'] as $value){
											$resultAddedAttrValue[$attr['ProductAttribute']['attribute_id']][] = $value['attribute_value_id'];
										}
									}
								}
							}
							//pr($resultAddedAttrValue);
							$attributeArr = array();
							$result = array();
							foreach($data as $datum){
								if(isset($resultAddedAttrValue[$datum['Attribute']['id']]) AND !empty($resultAddedAttrValue[$datum['Attribute']['id']])){
									if(!empty($datum['AttributeValue'])){
										foreach ($datum['AttributeValue'] as $attValue){
											if(in_array($attValue['id'],$resultAddedAttrValue[$datum['Attribute']['id']])){
												$result[$datum['Attribute']['id']][] = $attValue['id'];
											}
										}
									}
								}
							}
						}
						$newData = $this->generateCombination($result);
						$processData = array();
						$i = 0;
						$attributes = implode(array_values($addedAttributeArr), '|');
						foreach ($newData as $stock){
							$attrValues = implode(array_values($stock), '|');
							if(!in_array($attrValues, $addedAttrValueList)){
								$processData[$i]['ProductStock']['product_id']= $productId;
								$processData[$i]['ProductStock']['attributes'] = $attributes;
								$processData[$i]['ProductStock']['attributeValues'] = $attrValues;
								$i++;
							}
						}
						
						if($this->ProductStock->saveMany($processData)){
							$response['message'] = "Combination generated successfully";
						}else{
							$response['message'] = "Please try again.";
						}
					}else{
						$response['message'] = "Please Generate your combination.";
					}
				}
				return json_encode($response);
			}else{
				$response['message'] = "Create attribute for combination.";
				return json_encode($response);
			}
			
		}
		 
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductStock->exists($id)) {
			throw new NotFoundException(__('Invalid product stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
 			$this->ProductStock->query("UPDATE product_stocks SET quantity = (quantity + {$data['ProductStock']['quantity']}) WHERE id = '".$data['ProductStock']['id']."'");
			$this->Session->setFlash('The stock has been saved.','default',array('class'=>'alert alert-success'));
			return $this->redirect(array('action'=>'index',$data['ProductStock']['product_id']));
		} else {
			$options = array('recursive' =>-1,'conditions' => array('ProductStock.' . $this->ProductStock->primaryKey => $id));
			$this->request->data = $this->ProductStock->find('first', $options);
		}
		$requestData = $this->request->data;
		$productData = $this->Product->getProductById($requestData['ProductStock']['product_id']);
		$data = $this->getAttribute();
		$attributes = '';
		if(isset($requestData['ProductStock']['attributes'])):
		$attributes = explode('|', $requestData['ProductStock']['attributes']);
		endif;
		
		$attrValues = '';
		if(isset($requestData['ProductStock']['attributeValues'])):
		$attrValues = explode('|', $requestData['ProductStock']['attributeValues']);
		endif;
		$newArray = '';
		if(!empty($attrValues)){
			foreach($data as $datum){
				if(in_array($datum['Attribute']['id'],$attributes)){
					$newArray[$datum['Attribute']['title']] = array();
					foreach($datum['AttributeValue'] as $vl){
						if(in_array($vl['id'],$attrValues)){
							$newArray[$datum['Attribute']['title']]= $vl['value'];
						}
					}
				}
			}
		}
		
		$this->set('arrayData',$newArray);
		 
	}
	
	public function admin_update_stockQuantity() {
		$this->autoRender = false;
		if($this->request->is('Post')){
			$postData = $this->request->data;
			$result = false;
			$this->ProductStock->id = $postData['id'];
			$quantity = $postData['totalQuantity'];
			$data['ProductStock']['quantity'] = $quantity + $postData['currentStock'];
			//pr($data);
			if($this->ProductStock->save($data)){
				$this->ProductStock->query("UPDATE product_stocks SET quantity = (quantity - $quantity) WHERE product_id ='".trim($postData['productId']) ."' AND attributes IS NULL AND attributeValues IS NULL");
				$result = true;
	
			}else{
				$result = false;
			}
			return json_encode($result);
	
		}
	
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductStock->id = $id;
		if (!$this->ProductStock->exists()) {
			throw new NotFoundException(__('Invalid product stock'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProductStock->delete()) {
			$this->Session->setFlash('The product stock has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The product stock could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	//get attribue and attribue_value data if these are isCombination is true
	private function getAttribute(){
		return $data = $this->Attribute->find(
			'all',
			array(
				'order' => array('order' => 'ASC'),
				'contain' => array('AttributeValue'=>array('fields'=>array('id','value'))),
				'conditions'=>array('useCombination' => 1),
				'fields'=>array('id','title')
			)
		);
	}
	
	
	
	
	/**
	 * combination generator
	 *  @param array $input
	 */
	
	private function generateCombination($input) {
		$result = array();
		//pr(each($input));
			
		while (list($key, $values) = each($input)) {
			//pr($key);
			//pr($values);
			if (empty($values)) {
				continue;
			}
	
			if (empty($result)) {
	
				foreach($values as $value) {
					$result[] = array($key => $value);
				}
			}
			else {
					
				$append = array();
	
				foreach($result as &$product) {
	
					$product[$key] = array_shift($values);
	
					$copy = $product;
	
					foreach($values as $item) {
						$copy[$key] = $item;
						$append[] = $copy;
					}
					array_unshift($values, $product[$key]);
				}
				$result = array_merge($result, $append);
			}
		}
		return $result;
	}
	
	public  function admin_export($productId=null){
		$this->autoRender = false;
	
	
		// for saving data in excel and download start
		$filename='exported'.time().'.xls';
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		header("Pragma: no-cache");
		header("Expires: 0");
		// for saving data in excel and download end
	
		$fieldsArr=array('attributeValues', 'quantity', 'sold' );
		if($productId!=null){
	
			$getAttr=$this->ProductStock->find('first',array(
				'conditions'=>array(
					'product_id'=>$productId,
					'attributeValues !='=> ''),
				'fields'=>array('attributes')
			)
			);
	
			$listAttrValues=[];
			if(!empty($getAttr)){
				$allAttributes=$this->Attribute->find('all',array(
					'conditions'=>array('id'=>explode('|',$getAttr['ProductStock']['attributes'])),
					'fields'=>array('title')
				)
				);
				$listAllValues=[];
				foreach ($allAttributes as $key => $val) {
					$listAllValues[]=array_column($val['AttributeValue'],'value','id');
				}
				$listAttrValues=array_replace(...$listAllValues);
			}
				
	
			$stockData=$this->ProductStock->find('all',array(
				'conditions'=>array(
					'product_id'=>$productId,
					'attributeValues !='=>NULL),
				'fields'=>$fieldsArr
			)
			);
			//pr($stockData);
			echo implode($fieldsArr, "\t");print("\n");
			foreach ($stockData as $key => $value) {
				$explodedAttr=array_flip(explode('|', $value['ProductStock']['attributeValues']));
				$implodedAttr=implode('|',array_values(array_intersect_key($listAttrValues,$explodedAttr)));
				echo $implodedAttr."\t".
					$value['ProductStock']['quantity']."\t".
					$value['ProductStock']['sold']."\t";
				print("\n");
			}
		}else{
			echo implode($fieldsArr, "\t");print("\n");
		}
	}
	
	public  function admin_import($productId=null){
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$productId=$data['Product']['id'];
	
			$attrFields='';
			$getAttr=$this->ProductStock->find('first',array(
				'recurseve'=>-1,
				'conditions'=>array(
					'product_id'=>$productId,
					'attributeValues !='=> '')
			)
			);
	
	
			$listAttrValues=[];
			if(!empty($getAttr)){
				$attrFields=$getAttr['ProductStock']['attributes'];
				$allAttributes=$this->Attribute->find('all',array(
					'conditions'=>array('id'=>explode('|',$getAttr['ProductStock']['attributes'])),
					'fields'=>array('title')
				)
				);
				$listAllValues=[];
				foreach ($allAttributes as $key => $val) {
					$listAllValues[]=array_column($val['AttributeValue'],'id','value');
				}
				$listAttrValues=array_replace(...$listAllValues);
			}
	
	
			$file=$data['ProductStock']['file'];
			$fileName=$file['name'];
			$filePath=$file['tmp_name'];
			$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
			//for .xlsx 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			if(($file['error'] === 0) && ($file['type'] === 'application/vnd.ms-excel' || $fileExtension == 'xls')){
				$data = new Spreadsheet_Excel_Reader($filePath, true);
				$data->setOutputEncoding('UTF-8');
				$prodcutFromExcel = $data->dumptoarray();
	
				//pr($prodcutFromExcel);die();
					
				$dataArr = array();
	
				foreach ($prodcutFromExcel as  $key=>$value) {
	
					$explodedAttr=array_flip(explode('|', $value['attributevalues']));
					$implodedAttr=implode('|',array_values(array_intersect_key($listAttrValues,$explodedAttr)));
						
						
					$dataArr[]=[
					'product_id'		=> $productId,
					'attributes'		=>$attrFields,
					'attributeValues'	=> $implodedAttr,
					'quantity'			=> (int) $value['quantity'],
					'sold'				=> (int) $value['sold']
					];
	
				}
	
				if(count($dataArr)>0){
					$this->ProductStock->deleteAll(
						array('product_id'=>$productId,'attributeValues !='=> ''),false
					);
	
					$this->ProductStock->create();
					if($this->ProductStock->saveMany($dataArr)){
						return $this->redirect(array('action' => 'index',$productId));
					}else{
						$this->Session->setFlash("Somethig Wrong!! Please Try Again",'default',array('class'=>'alert alert-warning'));
						return $this->redirect(array('action' => 'import',$productId));
					}
				}else{
					$this->Session->setFlash("Somethig Wrong!! No Data Found To import",'default',array('class'=>'alert alert-warning'));
					return $this->redirect(array('action' => 'import',$productId));
				}
					
			}else{
				$this->Session->setFlash("{$fileName} is not readable. Please, try again.",'default',array('class'=>'alert alert-warning'));
				return $this->redirect(array('action' => 'import',$productId));
			}
	
		}
		$products=$this->Product->find('first',array(
			'recursive'=>-1,
			'conditions'=>array('id'=>$productId),
			'fields'=>array('id','title')
		)
		);
		$this->set('products',$products);
	}
}
