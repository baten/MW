<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ApisController extends ShippingAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
	public $uses = array('Shipping.Country','Shipping.Channel','Shipping.City','Shipping.State','Shipping.FedexChannel','Shipping.DpexChannel','Shipping.DhlChannel','Shipping.DimensionalWeight','Shipping.State');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();
	}
	
	public function division_list(){
		if($this->request->is('get')){
			//$country = $this->Division->find('list', array('order'=> array('Division.name' => 'ASC')));
	
			$data['status'] = true;
			//$data['message'] = $country;
	
		}else{
	
			$data['status'] = false;
			$data['message'] = 'Invalid Reqeust';
		}
	
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceDivision'=>$data),
				'_jsonp' => true
			)
		);
		$this->render('json_render');
	}
	
	//enable cors
	public function beforeRender(){
		$this->response->header('Access-Control-Allow-Origin', '*');
	}
	
	// country list
	
	public function country_list(){
		if($this->request->is('get')){			
			$model = $this->Country;
	     	$data = Cache::remember('all_countries', function() use ($model){
	         return $model->find('all',
						array(
							'fields'=>array('Country.country_code','Country.country_name'),
							'order'=>array('Country.country_name'=>'ASC'),
							'recursive'=>-1
						)
			         );
		         }, 'long');

			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCountry'=>$data),
					'_jsonp' => true
	
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCountry'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('json_render');
	}
	
	public function countryListSelectize(){
		if($this->request->is('get')){		
			$model = $this->Country;
	     	$data = Cache::remember('all_countries2', function() use ($model){
	         return $model->find('all',
						array(
							'fields'=>array('Country.country_code AS value','Country.country_name AS text'),
							'order'=>array('Country.country_name'=>'ASC'),
							'recursive'=>-1
						)
			         );
		         }, 'long');
			$newData = Set::extract('/Country/.', $data);
				
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCountry'=>$newData),
					'_jsonp' => true
	
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCountry'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('json_render');
	}
	
	// citiy list2
	public function city_list2(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
				
			$data = $this->City->find(
				'list',
				array(
					'order'=>array('city_name'=>'ASC')
				)
			);
				
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCity'=>$data),
					'_jsonp' => true
	
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCity'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('json_render');
	}
	
	// citiy list
	public function city_list(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			
			$data = $this->City->find(
				'all',
				array(					
					'conditions'=>array(
						'country_code'=>$postData['country_code'],
						'state_code'=>$postData['state_code']
						),
					'fields'=>array('id','city_name'),
					'order'=>array('city_name'=>'ASC'),
					'recursive'=>-1
					)
				);			
			
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCity'=>$data),
					'_jsonp' => true
	
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCity'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('json_render');
	}
	
	public function citylistSelectize(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);			
				
			$data = $this->City->find(
				'all',
				array(
					'fields' => array('City.id as value','City.city_name as text'),
					'conditions'=>array('country_code'=>$postData['country_code'],'state_code'=>$postData['state_code'],),
					'order'=>array('City.city_name'=>'ASC'),
					'recursive'=>-1
				)
			);
					
			$newData = Set::extract('/City/.', $data);
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCity'=>$newData),
					'_jsonp' => true
	
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceCity'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('json_render');
	}
	
	public function get_state_list(){
		if($this->request->is('post')){
			$response = array();
			$postData = $this->request->input('json_decode',true);
			//pr($postData);
	
			$data = $this->State->find(
				'list',
				array(
					'conditions'=>array('State.country_code'=>$postData['country_code']),
					'fields' => array('State.state_code','State.state_name'),
					'order'=>array('State.state_name'=>'ASC'),
					'recursive'=>-1
				)
			);
			if(count($data) > 0){
				$response = $data;
			}
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceState'=>$response),
					'_jsonp' => true
	
				)
			);
			
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceState'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('json_render');
	}
	
	
	public function stateListSelectize(){
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			//pr($postData);
	
			$data = $this->State->find(
				'all',
				array(
					'conditions'=>array('State.country_code'=>$postData['country_code']),
					'fields' => array('State.state_code as value','State.state_name as text'),
					'order'=>array('State.state_name'=>'ASC'),
					'recursive'=>-1
				)
			);
			$newData = Set::extract('/State/.', $data);
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceState'=>$newData),
					'_jsonp' => true
	
				)
			);
		}else{
			$this->set(
				array(
					'_serialize',
					'data' => array('ecommerceState'=>'Invalid Request'),
					'_jsonp' => true
				)
			);
		}
		$this->render('json_render');
	}
	
	//get country and city list
	
	public function country_city_list(){
		if($this->request->is('post')){
			$countries = $this->Country->find('list');
			$cities = $this->City->find('list');
			$data['country'] = $countries;
			$data['city'] = $cities;
			//process data
			$data['status'] = true;
			$data['message'] = 'Country and City list is sent.';
				
		}else{
				
			$data['status'] = false;
			$data['message'] = 'Invalid Reqeust';
		}
		
		$this->set(
				array(
						'_serialize',
						'data' => array('countryCityList'=>$data),
						'_jsonp' => true
				)
		);
		$this->render('json_render');
	}
	public function getCountryState(){
		$response = array();
		$postData = $this->request->input('json_decode',true);
		if($this->request->is('post')){
			$postData = $this->request->input('json_decode',true);
			$country= $this->Country->find(
				'first',
				array(
					'recursive'=>-1,
					'contain'=>array('State'=>array('conditions'=>array('state_name'=>$postData['stateName']))),
					'fields'=>array('country_code'),
					'conditions'=>array('country_name'=>$postData['countryName'])
					)
				);
				$data = $this->State->find(
				'all',
				array(
					'conditions'=>array('State.country_code'=>$country['Country']['country_code']),
					'fields' => array('State.state_code as value','State.state_name as text'),
					'order'=>array('State.state_name'=>'ASC'),
					'recursive'=>-1
				)
			);
			$newData = Set::extract('/State/.', $data);
			$data['status'] = true;
			$data['Country'] = $country;
			$data['State'] = $newData;
		
		}else{
			$data['status'] = false;
			$data['message'] = 'Invalid Reqeust';
			 
		}
		
		$this->set(
			array(
				'_serialize',
				'data' => array('ecommerceCountryState'=>$data),
				'_jsonp' => true
				)
			);
			
		$this->render('json_render');
	}
 
	 public function getShippingCost(){
	  $data = array();
	  if($this->request->is('post')){
	   $postData = $this->request->input('json_decode',true);
	    
	   $countryState = $this->Country->find(
	   		'first',
	   		array(
	   			'recursive'=>-1,
	   			'fields'=>array('country_code'),
	   			'contain'=>array('State'=>array('fields'=>array('state_code'),'conditions'=>array('OR'=>array('state_name'=>$postData['state'],'state_code'=>$postData['state'])))),
	   			'conditions'=>array('OR'=>array('country_name'=>$postData['country'],'country_code'=>$postData['country']))
	   		)
	   	);
		$shippingCost = $this->Channel->find(
		 'list',
		 array(
		  'recursive' => -1,
		 'fields' => array('weight','price'),
		 'order' => array('weight' => 'ASC'),
		  'conditions' => array(
		   'country_code' => $countryState['Country']['country_code'],
		   'state_code' => $countryState['State'][0]['state_code']
		  )
		 )
		);
	  	if(!empty($shippingCost)){
	 	  $data['status'] = true;
		  $data['message'] = reset($shippingCost);
		}else{
		 $data['status'] = false;
		 $data['message'] = "Shipping is not available.";
		}
	   
	  }else{
	   $data['status'] = false;
	   $data['message'] = 'Invalid Reqeust';
	  }
	  
	  $this->set(
		array(
		 '_serialize',
		 'data' => array('shippingDetails'=>$data),
		 '_jsonp' => true
		)
	  );
	  $this->render('json_render');
	  
	 }
	
}