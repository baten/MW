<?php
App::uses('AppController', 'Controller');

App::uses('CakeTime', 'Utility');
//App::uses('CakeEmail', 'Network/Email');

class ShopsController extends AppController {


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','EmailSender','Localization');

	public $uses= array(		
		'Basket',
		'WebPage',
		'SiteSetting',
		'Ecommerce.Product',
		'Ecommerce.Category',
		'Ecommerce.ProductCategory',
		'Timeout.Gallery',
		'Ecommerce.ProductOrder',
		'Ecommerce.ProductOrderNote'
		);
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();					
		if($this->langsName=='English'){
			$this->layout = 'shop_en';
		}else{
			$this->layout = 'shop';
		}
		
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function index() {	
	//pr($this->Localization->langsArray[$this->langsName]['msg1']);	
		//$banners=$this->Gallery->find('all',array('fields' => array('id','title','caption','image_extension')));
		if($this->langsName=='English'){
			$this->Product->tablePrefix = 'english_';
		}
		$contents=$this->Product->find('all',array('contain'=>array('ProductImage'=>array('limit'=>'1')),'fields'=>array('Product.product_code','Product.title','Product.price','Product.short_description'),'conditions'=>array('is_home'=>'1','status'=>'active'),'order'=>array('created DESC'),'limit'=>20));
		$this->set('contents',$contents);
		/*Add to cart product Session id create*/
		$session_read = $this->Session->read('sessionID');
		//$pre_basket = $this->check_user_basket($session_read,$id);
		//$this->set('pre_basket',$pre_basket);
		if(empty($session_read)){
			$sessionID = date('yhisa');
			$this->Session->write('sessionID',$sessionID);
		}
		
		if($this->langsName=='English'){
			$this->autoRender = false;
			$this -> render('en/index');				
		}
		
	}

	public function impressum(){
		$this->layout = 'impressum';		
		if($this->langsName=='English'){
			$this->autoRender = false;
			$this -> render('en/impressum');				
		}
	}

	public function termAndConditions(){
		$this->layout = 'impressum';
		if($this->langsName=='English'){
			$this->autoRender = false;
			$this -> render('en/term_and_conditions');				
		}

	}
	
	public function menu(){	
		if($this->langsName=='English'){
			    $this->Category->tablePrefix = 'english_';
				$this->Product->tablePrefix = 'english_';
			}	
		if ($this->request->is('post')) {

			$data=$this->request->data;
			if(isset($data['G'])){$G=$data['G'];}else{$G='somethingElse';}
			if(isset($data['A'])){$A=$data['A'];}else{$A='somethingElse';}		

			if(isset($data['Product']['search2'])){
				if($data['Product']['search2']=='vegan'){
					$search2=array(
							"Product.food_item"=>'vegan'
						);
				}else{
					$search2=array(
							'OR'=>array(
								"Product.food_item <> "=>$data['Product']['search2'],
								"Product.food_item"=>NULL,
							)
						);
				}
				
			}else{				
				$search2=array();
			}

			$conditionss=array(					
						"Product.ingredients NOT LIKE '%\"".$G."\"%'",
						"Product.ingredients NOT LIKE '%\"".$A."\"%'",
						'AND'=>$search2				
						);
			
			//pr($conditions);exit;
			$categories = $this->Category->find('threaded', array(
		    		'contain' 	=>array('ProductCategory.Product'=>array(
		    			'fields' 		=> array('id','product_code','title','price','vat','short_description','ingredients','food_item','spicy_level'),
		    			'conditions'	=>$conditionss,		    			
		    			'ProductImage'	=>array('limit'=>'1')
		    			)
		    		),
		    		'fields' 	=> array('id','parent_id', 'title','image_extension'),
		    		'conditions'=>array('status'=>'active'),
		    		'order'		=>array('order'=>'asc')
				));

		}else{
			$data=null;
			$categories = $this->Category->find('threaded', array(
		    		'contain' 	=>array('ProductCategory.Product'=>array(
		    			'fields' 		=> array('id','product_code','title','price','vat','short_description','ingredients','food_item','spicy_level'),
		    			'conditions'	=>array('status'=>'active'),
		    			'ProductImage'	=>array('limit'=>'1')		    			
		    			)
		    		),
		    		'fields' 	=> array('id','parent_id', 'title','image_extension'),
		    		'conditions'=>array('status'=>'active'),
		    		'order'		=>array('order'=>'asc')
				));
		}	
		//pr($categories);exit;	
		$this->request->data = $data;
		$this->set('categories',$categories);

		/*Add to cart product Session id create*/
		$session_read = $this->Session->read('sessionID');
		//$pre_basket = $this->check_user_basket($session_read,$id);
		//$this->set('pre_basket',$pre_basket);
		if(empty($session_read)){
			$sessionID = date('yhisa');
			$this->Session->write('sessionID',$sessionID);
		}		
		if($this->langsName=='English'){
			$this->autoRender = false;
			$this -> render('en/menu');				
		}
	}
	public function checkout(){					
		if($this->request->is('post')){
			$data=$this->request->data;						
			if($data['Condition']['term']==true){

				/*if($data['Condition']['account']==true){
					$uerdetails=$data['Client'];
					unset($uerdetails['email']);
					//pr($uerdetails);exit;
					$duser['User']['username']=$data['Client']['email'];
					$duser['User']['password']=$data['Client']['password'];
					$duser['User']['personal_details'] = json_encode($uerdetails, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
					$duser['User']['role_id']='57148561-ab40-4f71-8b0f-0d00cdd1d5ac';		
					$duser['User']['status']='active';
					//pr($duser);exit;
						$user=ClassRegistry::init('User');
						$user->create();
						$user->Save($duser['User']);
				}*/
						
				if($data['Payment']['type']=='cash_on_delivery'){
					//pr($data);exit;
				$dat['ProductOrder']['order_code']=uniqid();
				$dat['ProductOrder']['client_detail']=json_encode($data['Client'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
				$dat['ProductOrder']['order_detail']=json_encode($data['Order'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
				$dat['ProductOrder']['payment_detail']=$data['Payment']['type'];
				$dat['ProductOrder']['status']='ordered';							
				$this->ProductOrder->create();
				if($this->ProductOrder->save($dat)){
					if(!empty($data['OrderNote']['message'])){
						$datt['ProductOrderNote']['product_order_id']=$dat['ProductOrder']['order_code'];
						$datt['ProductOrderNote']['note']=$data['OrderNote']['message'];
						$dat['ProductOrder']['note']=$data['OrderNote']['message'];
						$this->ProductOrderNote->create();
						$this->ProductOrderNote->Save($datt);
					}

					return $this->redirect(array('plugin' => 'ecommerce', 'controller' => 'productOrders', 'action' => 'order_view', $this->ProductOrder->id, 'pdf', 'save','admin' => false));

				}else{
					$this->Session->setFlash($this->Localization->langsArray[$this->langsName]['emailError'],'default',array('class'=>'alert alert-info'));
						return $this->redirect(array('controller'=>'shops','action' => 'confirmation'));
				};

				}else{
					//pr($data);exit;
					$this->Session->write('formData',json_encode($data));	
					$this->redirect(array('controller'=>'shops','action' => 'proceed'));
				}

			}		
		}
		

		if($this->langsName=='English'){
			$this->autoRender = false;
			$this -> render('en/checkout');				
		}


		
	}


	private function getClientToken(){		
		Braintree_Configuration::environment('sandbox');
		Braintree_Configuration::merchantId('ngrcphskhk37hhnh');
		Braintree_Configuration::publicKey('wzm7zjs3mbdtzssd');
		Braintree_Configuration::privateKey('de1908451344048c6b8021114f3c3906');	
		return  Braintree_ClientToken::generate();
	}

	public function proceed(){		
		$this->set('clientToken',$this->getClientToken());		
		if($this->request->is('post')){			
			$data=$this->request->data;				

			if(!empty($data['Card']['nonce'])){
				$nonce=$data['Card']['nonce'];
			}else{
				$nonce=$data['payment_method_nonce'];
			}	
			//pr($nonce);exit;

			$gTotal=$data['Order']['total_price'];
    		//$vat=$gTotal-($gTotal/(1+0.07));
    		$priceIncludeTax=number_format($gTotal,2);

			$result = Braintree_Transaction::sale([
			  'amount' => (float)$priceIncludeTax,
			  'paymentMethodNonce' => $nonce,
			  'options' => [
			    'submitForSettlement' => True
			  ]
			]);	

			/*$result = Braintree_PaymentMethod::create([
			    'customerId' => 'the_customer_id',
			    'paymentMethodNonce' => $nonce,
			    'options' => [
			        'verifyCard' => true
			    ]
			]);*/

			if($result->success){
				
				$dat['ProductOrder']['order_code']=uniqid();
				$dat['ProductOrder']['client_detail']=json_encode($data['Client'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
				$dat['ProductOrder']['order_detail']=json_encode($data['Order'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
				$dat['ProductOrder']['payment_detail']='payment-method';
				$dat['ProductOrder']['status']='ordered';						
				$this->ProductOrder->create();
				if($this->ProductOrder->save($dat)){
					if(!empty($data['OrderNote']['message'])){
						$datt['ProductOrderNote']['product_order_id']=$dat['ProductOrder']['order_code'];
						$datt['ProductOrderNote']['note']=$data['OrderNote']['message'];
						$dat['ProductOrder']['note']=$data['OrderNote']['message'];
						$this->ProductOrderNote->create();
						$this->ProductOrderNote->Save($datt);
					}	
					return $this->redirect(array('plugin' => 'ecommerce', 'controller' => 'productOrders', 'action' => 'order_view', $this->ProductOrder->id, 'pdf', 'save','admin' => false));					

				}else{
					$this->Session->setFlash($this->Localization->langsArray[$this->langsName]['orderError'],'default',array('class'=>'alert alert-danger'));
					return $this->redirect(array('controller'=>'shops','action' => 'checkout'));
				};	


			}else{				
				$this->set("errors",$result->errors->deepAll());
				//$this->Session->setFlash('The Order Could not be saved.','default',array('class'=>'alert alert-danger'));
					//return $this->redirect(array('controller'=>'shops','action' => 'proceed'));
			}
		}else{
			$formData=$this->Session->read('formData');
			$this->request->data=json_decode($formData,true);
		}	
	}

function confirmation($orderId=NULL){
   		$sessionRead = $this->Session->read('sessionID');
   		//delete baskte data						
		$this->Basket->deletBasketAll($sessionRead);
		$this->Session->delete('pdfdata');

					
          if($orderId){

          	
	         $siteSettingData=$this->SiteSetting->find('first',array('fields' => array('site_author_email', 'kitchen_email','company_name')));
	   
	          	$options = array(
	          		'conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $orderId
	          		)
	          	);
	          
        	  $order_data = $this->ProductOrder->find('first', $options);
        	  if(count($order_data)>0){
        	  	$note=$this->ProductOrderNote->find('first', array('fields'=>'note','conditions'=>array('ProductOrderNote.product_order_id'=>$order_data['ProductOrder']['order_code'])));
        	 	$order_data['ProductOrder']['note']=$note['ProductOrderNote']['note'];
        	  }
        	  
        	  $clientData= json_decode($order_data['ProductOrder']['client_detail'], true);
        	  
			//$this->SiteSetting->id = '54219a9b-f910-4d8c-9515-0ae112142117';
			//$admin_email = $this->SiteSetting->field('emails');
			//$kitchen_email = $this->SiteSetting->field('kitchen_email');

        	//for client email
			$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
			$emailConfig['from_name'] =$siteSettingData['SiteSetting']['company_name'];
			$emailConfig['to'] =$clientData['email'];			
			$emailConfig['subject'] = $this->Localization->langsArray[$this->langsName]['emailSub'];
			$emailConfig['template'] =  $this->Localization->langsArray[$this->langsName]['OrderTamplate'];
			$emailConfig['data'] = $order_data;

			//for kitchten email
			$emailConfig2['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
			$emailConfig2['from_name'] =$siteSettingData['SiteSetting']['company_name'];
			$emailConfig2['to'] =$siteSettingData['SiteSetting']['kitchen_email'];			
			$emailConfig2['subject'] = $this->Localization->langsArray[$this->langsName]['emailSub'];
			$emailConfig2['template'] =  'ordersuccess_kitchen';
			$emailConfig2['data']=array();


			$fileName="order-{$orderId}.pdf";
          	$filePath = WWW_ROOT.'files/'.$fileName;
            //$emailConfig2['attachments'] = array('name' => $fileName, 'file_path' => $filePath);
            $emailConfig2['attachments'] =$filePath;

			//pr($emailConfig);exit;
			if($this->EmailSender->sendEmail($emailConfig)){
				$this->EmailSender->sendEmail($emailConfig2);					
				$this->Session->setFlash($this->Localization->langsArray[$this->langsName]['orderSuccess'],'default',array('class'=>'alert alert-success'));
				//return $this->redirect(array('controller'=>'shops','action' => 'confirmation'));
			}else{
				$this->Session->setFlash($this->Localization->langsArray[$this->langsName]['emailError'],'default',array('class'=>'alert alert-danger'));
				return $this->redirect(array('controller'=>'shops','action' => 'checkout'));

			}	


          }		

   }

	

	function check_user_basket($session_read,$product_id){			
			$query2  = $this->Basket->find('first',array('conditions'=>array('Basket.product_id'=>$product_id,'Basket.basketSession'=>$session_read),'fields'=>array('Basket.total_quantity')));
			if(!empty($query2)){
				return $query2['Basket']['total_quantity'];
			}else{
				return 0;
			}			
	}	
	
	function check_user_basket2(){			
			$this->autoRender=false;
			$session_read = $this->Session->read('sessionID');
			$product_id=$this->request->data['id'];			
			$query2  = $this->Basket->find('first',array('conditions'=>array('Basket.product_id'=>$product_id,'Basket.basketSession'=>$session_read),'fields'=>array('Basket.total_quantity')));
			if(!empty($query2)){
				return $query2['Basket']['total_quantity'];
			}else{
				return 0;
			}			
	}

	function addToBasket(){
		//$this->layout = 'ajax';
		$this->autoRender=false;
		$session_read = $this->Session->read('sessionID');
		if( !empty($_POST['action']) && !empty($_POST["quantity"]) )
		{
						$action 	= $_POST['action'];
						$product_id	= $_POST['productID'];
						$quantity	= $_POST["quantity"];						
		}		
		
		if(!empty($action))
        {

        	$productInBasket 	= 0;
			$productTotalPrice	= 0;
			$totalItems = '';
			
			$this->Product->recursive =1;
			$query = $this->Product->find('first',array('fields'=>array('Product.title','Product.price'),'conditions'=>array('Product.id'=>$product_id)));
 			
			$this->request->data['Basket']['productPrice'] =$query['Product']['price'];
			$this->request->data['Basket']['product_id'] = $product_id;
			$this->request->data['Basket']['total_quantity'] = $quantity;
			$this->request->data['Basket']['basketSession'] = $session_read;				
			$productName = $query['Product']['title'];

		if ($action == "addToBasket"){    
    			$pre_query  = $this->Basket->find('first',array('conditions'=>array('Basket.product_id'=>$product_id,'Basket.basketSession'=>$session_read)));		
    			
				if(!empty($pre_query)){					
					$this->request->data['Basket']['total_quantity'] = $pre_query['Basket']['total_quantity'] + $quantity;
					
					if(count($pre_query) > 0 ){
						$this->request->data['Basket']['id'] = $pre_query['Basket']['id'];
					}else{
						$this->Basket->create();    
					}
				}
				
				if(!empty($this->request->data['Basket'])){
    			  	 $this->Basket->save($this->request->data['Basket']);
                }
    		
    			
    		
    	}else if ($action == "updateToBasket"){    
    			$pre_query  = $this->Basket->find('first',array('conditions'=>array('Basket.product_id'=>$product_id,'Basket.basketSession'=>$session_read)));		
    			
				if(!empty($pre_query)){					
						$this->request->data['Basket']['id'] = $pre_query['Basket']['id'];					
				}
                if($quantity < 1){
                	$this->Basket->delete($this->request->data['Basket']['id']);
                }else{
                	$this->Basket->save($this->request->data['Basket']);
                }    		
    		
    	}
			
			$query  = $this->Basket->find('first',array('conditions'=>array('Basket.product_id'=>$product_id,'Basket.basketSession'=>$session_read)));
            $this->set("basket",$query);
		}
		
	}
	
	

   
	 
    function cart_summury_process()
    {
        
      $basket_query = $this->top_cart_query();
     
	   
	   $total_qty = 0;
       $total_price = 0;
        
        foreach($basket_query as $product)
        {
            $prod_qty = $product['Basket']['total_quantity'];
            $unit_price =  $product['Basket']['productPrice'];

            $total_qty += $prod_qty;            
            $total_price+=$prod_qty*$unit_price;         
       }
       $cart_summuary["total_qty"] = $total_qty;
       $cart_summuary["total_price"] = $total_price;
       
       return $cart_summuary; 
        
    }

    function cart_summary_title(){
       $this->layout = 'ajax';
	   $cart_summuary = $this->cart_summury_process(); 
	   $this->set('cartsummary',$cart_summuary);       
    }
	
	function cart_summary_top(){
       $this->layout = 'ajax';
	   $cart_summuary = $this->cart_summury_process(); 
	   $this->set('cartsummarytop',$cart_summuary);       
    }
    
	function update_cart_summary_title(){
		$this->layout = 'ajax';
		$cart_summuary = $this->cart_summury_process();
		
		if(isset($this->request->params['requested'])) {
			return $cart_summuary;
		}	

	}    
    
	function update_top_cart(){
		$this->layout = 'ajax';
		$query = $this->top_cart_query();
		
		if(isset($this->request->params['requested'])) {
			return $query;
		}
	}     
 
    
    function top_cart_query(){

		$session_read = $this->Session->read('sessionID');
		$condition = array('conditions'=>
								array('Basket.basketSession'=>$session_read),
									'contain'=>array('Product'=>array('fields'=>array('title','price','product_code','ingredients','vat')),'Product.ProductImage'=>array('limit'=>1),'Product.ProductCategory.Category'=>array('fields'=>array('title'))),
							);
		$tocartquery  = $this->Basket->find('all',$condition);		
		return $tocartquery;
    }
	
	function update_mycart(){
		$this->layout = 'ajax';
		$session_read = $this->Session->read('sessionID');
		$condition = array('conditions'=>
								array('Basket.basketSession'=>$session_read),
								'contain'=>array('Product'=>array('fields'=>array('title','price','ingredients','vat')),'Product.ProductImage'=>array('limit'=>1),'Product.ProductCategory.Category'=>array('fields'=>array('title'))),
							);
		$tocartquery  = $this->Basket->find('all',$condition);
		$this->set('tocartquery',$tocartquery);
		
		$update_cart_summary_title = $this->cart_summury_process();
        $this->set('update_cart_summary_title',$update_cart_summary_title);
    }

  function update_menu_mycart(){
		$this->layout = 'ajax';
		$session_read = $this->Session->read('sessionID');
		$condition = array('conditions'=>
								array('Basket.basketSession'=>$session_read),
								'contain'=>array('Product'=>array('fields'=>array('id','title','price','product_code','ingredients','vat'))),
							);
		$tocartquery  = $this->Basket->find('all',$condition);
		$this->set('tocartquery',$tocartquery);
		
		$update_cart_summary_title = $this->cart_summury_process();
        $this->set('update_cart_summary_title',$update_cart_summary_title);
    }


  	function deletebasketdata($id = null){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for content'));
				$this->redirect(array('action' => 'index'));
			}	
			$session_read = $this->Session->read('sessionID');		
			if ($this->Basket->delete($id)) {
				//$this->Session->setFlash(__('Addtocart Product information has been deleted successfully'));
				$data=$this->Basket->find('first',array('fields'=>array('id'),'conditions'=>array('Basket.basketSession'=>$session_read),'recursive'=>-1));
				if(count($data)>0){
					$this->redirect($this->request->referer());	
				}else{
					$this->redirect(array('controller'=>'shops','action'=>'menu'));
				}
							
			}
			$this->Session->setFlash(__('Content was not deleted'));
			$this->redirect($this->request->referer());			
 	}  

}
