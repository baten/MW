<?php
App::import('Vendor', 'Ecommerce.icepay', array('file' => 'icepay/icepay_api_basic.php'));

class IcepayComponent extends Component {
	public $merchantId 		= '25227';
	public $secrectCode 	= 'r8MRx39ZzNw6m5PEs7b4DYa67CtFf8d3WGj45Key';
	
    public function processPaymentObject($data){ 
    	//get issueres
    	//$issuer = new Icepay_Paymentmethod_Ideal();
    	//$issuers = $issuer->getSupportedIssuers();
		$paymentObj = new Icepay_PaymentObject();
    			$paymentObj->setAmount($data['amount'])
    			->setCountry("NL")
    			->setLanguage("NL")
    			->setReference("Timeout")
    			->setDescription("Timeout Payment")
    			->setCurrency("EUR")
    			->setOrderID($data['order_id']);
    			//->setPaymentMethod($data['method']);
    			return $paymentObj;
    }
 
 	public function getPayNowUrl ($paymentObj,$order_id){
 		// Set the service
		 try {
		 	/*
		 	$service = Icepay_Api_Webservice::getInstance()->paymentService();
		 	$service->setMerchantID($this->merchantId)
		 	->setSecretCode($this->secrectCode)
		 	->setSuccessURL("http://localhost:9000/#/shop/order/{$order_id}")
		 	->setSuccessURL("http://localhost:9000/#/shop/order/{$order_id}");
		 	$transactionObj = $service->checkOut($paymentObj);
		 	$payNowUrl = $transactionObj->getPaymentScreenURL();
		 	
		   */ // Merchant Settings
		     $basicmode = Icepay_Basicmode::getInstance();
		     $basicmode->setMerchantID($this->merchantId)     
		             ->setSecretCode($this->secrectCode)
		             ->validatePayment($paymentObj)
		     		 ->setSuccessURL("http://timeoutstore.com/#/shop/order/{$order_id}")
		     		 ->setSuccessURL("http://timeoutstore.com/#/shop/order/{$order_id}");
		 
		 $payNowUrl = $basicmode->getURL();
		
		 return $payNowUrl;
		     
		 } catch (Exception $e){
		     return $e->getMessage();
		 }
 	}
 	
 	public function getPaymentMethods(){
 			
 		$service = Icepay_Api_Webservice::getInstance()->paymentMethodService();
 			
 		// Configure the service
 		$service->setMerchantID($this->merchantId)
 		->setSecretCode($this->secrectCode)
 		->retrieveAllPaymentmethods();
 			
 			
 		/* Alternatively you can also fetch the paymentmethods object and/or array. */
 		$paymentMethods = $service->retrieveAllPaymentMethods()->asArray();
 			
 		return $paymentMethods;
 	}
 	
 	

}