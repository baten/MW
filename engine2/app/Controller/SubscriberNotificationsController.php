<?php
App::uses('AppController', 'Controller');
/**
 * SubscriberNotifications Controller
 *
 * @property SubscriberNotification $SubscriberNotification
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SubscriberNotificationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'EmailSender');
	public $uses = array('SubscriberNotification','SubscriberNotificationDetail');
	
	public $searchtype = array('1' => 'Custom','2'=>'All');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('searchtype',$this->searchtype);
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->SubscriberNotification->recursive = 0;
		$this->set('subscriberNotifications', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->SubscriberNotification->exists($id)) {
			throw new NotFoundException(__('Invalid subscriber notification'));
		}
		$options = array('conditions' => array('SubscriberNotification.' . $this->SubscriberNotification->primaryKey => $id));
		$this->set('subscriberNotification', $this->SubscriberNotification->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SubscriberNotification->create();
			if ($this->SubscriberNotification->save($this->request->data)) {
				$this->Session->setFlash('The subscriber notification has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The subscriber notification could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->SubscriberNotification->exists($id)) {
			throw new NotFoundException(__('Invalid subscriber notification'));
		}
		$subscriptionFilePath = WWW_ROOT . 'img' . DS . 'site' . DS . 'subscription' . DS;
		
		$subscribers = $this->SubscriberNotificationDetail->Subscriber->find('list',array('fields'=>array('id','email'),'conditions'=>array('status'=>'active')));
		$this->set('subscribers',$subscribers);
		$options = array('conditions' => array('SubscriberNotification.' . $this->SubscriberNotification->primaryKey => $id));
		$existingData = $this->SubscriberNotification->find('first', $options);
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if($data['SubscriberNotification']['subscriberSrc'] == array_search('All', $this->searchtype)){
				$arrayTo = $subscribers;
			}else{
				$arrayTo = array_intersect_key($subscribers, array_flip($data['SubscriberNotification']['subscriber_id']));
			}
			 
			$saveData['SubscriberNotification']['id'] = $id;
			if(isset($data['SubscriberNotification']['attachFile']) && $data['SubscriberNotification']['attachFile']['error'] == 0){
				$saveData['SubscriberNotification']['file_extension'] = $this->Uploader->getFileExtension($data['SubscriberNotification']['attachFile']);
				if($existingData['SubscriberNotification']['file_extension'] == $saveData['SubscriberNotification']['file_extension']){
					$this->Uploader->upload($data['SubscriberNotification']['attachFile'], $id, $saveData['SubscriberNotification']['file_extension'], 'subscription',$fileOrImage = 'file', $height = '', $width = '', $oldfile = null );
				}else{
					$file = WWW_ROOT."img".DS."site".DS."subscription".DS.$id.".".$existingData['SubscriberNotification']['file_extension'];
					$this->Uploader->deleteFile($file);
					$this->Uploader->upload($data['SubscriberNotification']['attachFile'], $id, $saveData['SubscriberNotification']['file_extension'], 'subscription',$fileOrImage = 'file', $height = '', $width = '', $oldfile = null );
				}
				
				$emailConfig['attachments'] = array($subscriptionFilePath . $id . '.' . $saveData['SubscriberNotification']['file_extension']);
			}
			 
			if ($this->SubscriberNotification->save($saveData)) {
				$siteSettingData = $this->SiteSetting->getSiteSettingId();
				$dataArray['SiteSetting'] = $siteSettingData['SiteSetting'];
				$dataArray['message'] = $data['SubscriberNotification']['message'];
				//send email
				$emailConfig['from_email'] = $siteSettingData['SiteSetting']['site_author_email'];
				$emailConfig['from_name'] = $siteSettingData['SiteSetting']['company_name'];
				
				$emailConfig['subject'] = $data['SubscriberNotification']['title'];
				$emailConfig['template'] = 'subscriber_notification';
					
				$emailConfig['data'] = $dataArray;
				$saveDataForSND = array();
				foreach($arrayTo as $key => $to ){
					$emailConfig['to'] = $to;
					$saveDataForSND[]['subscriber_id'] = $key;
					$this->EmailSender->sendEmail($emailConfig);
				}
				$this->SubscriberNotificationDetail->saveMany($saveDataForSND);
				
				$this->Session->setFlash('The subscriber notification has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The subscriber notification could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
			
		} else {
			$this->request->data = $existingData;
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
		$this->SubscriberNotification->id = $id;
		if (!$this->SubscriberNotification->exists()) {
			throw new NotFoundException(__('Invalid subscriber notification'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SubscriberNotification->delete()) {
			$this->Session->setFlash('The subscriber notification has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The subscriber notification could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
