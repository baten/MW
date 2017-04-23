<?php
App::uses('AppController', 'Controller');

class AjaxsController extends AppController {


	public $components = array('Session','EmailSender','Localization');

	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();
		$this->layout = 'ajax';
	}



	public function reservations(){
		$this->autoRender=false;
		//return $this->params->query;
		//return json_encode($this->request->data);
		$dat['message']= $this->Localization->langsArray[$this->langsName]['reservationSuccess'];
		$data=$this->request->data;
		$date=date_create($data['Reservation']['date']);		
		$data['Reservation']['date']=date_format($date,"Y-m-d");
		$data['Reservation']['lang_id']=$this->Localization->langsArray[$this->langsName]['lang_id'];
		$reservation=ClassRegistry::init('Ecommerce.Reservation');
		$reservation->create();
		if($reservation->save($data['Reservation'])){
			$siteSettings=ClassRegistry::init('SiteSetting');
			$siteSettingData=$siteSettings->find('first',array('fields' => array('site_author_email','company_name')));	
			//$emailConfig['from_email'] = 'info@nrbbuysell.com'; //'joopdeyn@msn.com';
			$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
			$emailConfig['from_name'] =$siteSettingData['SiteSetting']['company_name'];
			$emailConfig['to'] =$data['Reservation']['email'];			
			$emailConfig['subject'] =$this->Localization->langsArray[$this->langsName]['reservationSubject'];
			$emailConfig['template'] = $this->Localization->langsArray[$this->langsName]['reservationTamplate'];
			$emailConfig['data'] = $dat;
			//pr($emailConfig);exit;
			if($this->EmailSender->sendEmail($emailConfig)){						
				return 'sent';
			}else{
				return 'save';
			}
		}else{
			return 'wrong';
		}
		
	}

	
	function checkuserName(){
		$this->autoRender = false;
     	$username=$this->request->data['username'];     	
     	$user=ClassRegistry::init('User')->find('first',array('conditions'=>array('username'=>$username),'fields'=>array('id')));
     	if($user){
     		return 1;
     	}else{
     		return 0;
     	}
	}

	function setSession(){
		$this->autoRender = false;
		$languageName=$this->request->data['languageName'];   
		$this->Session->write('langsName',$languageName);		
	}

}
