<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * FedexChannels Controller
 *
 * @property FedexChannel $FedexChannel
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FedexChannelsController extends ShippingAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Shipping.FedexChannel','Shipping.State');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->FedexChannel->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
							"FedexChannel.price LIKE '%".$this->request->data['FedexChannel']['keywords']."%'",
							"FedexChannel.country_code LIKE '%".$this->request->data['FedexChannel']['keywords']."%'",
							"Country.country_name LIKE '%".$this->request->data['FedexChannel']['keywords']."%'"
							
							
					)
				)
			);
		}
		$this->set('fedexchannels', $this->Paginator->paginate());
	} 

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->FedexChannel->exists($id)) {
			throw new NotFoundException(__('Invalid fedexchannel'));
		}
		$options = array('conditions' => array('FedexChannel.' . $this->FedexChannel->primaryKey => $id));
		$this->set('fedexchannel', $this->FedexChannel->find('first', $options));
	}


/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->FedexChannel->exists($id)) {
			throw new NotFoundException(__('Invalid fedexchannel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FedexChannel->save($this->request->data)) {
				$this->Session->setFlash('The fedexchannel has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The fedexchannel could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('FedexChannel.' . $this->FedexChannel->primaryKey => $id));
			$this->request->data = $this->FedexChannel->find('first', $options);
		}
		
		$countries = $this->FedexChannel->Country->find('list',array('conditions' => array('country_code'=>$this->request->data['FedexChannel']['country_code'])));
		
		$this->set(compact('countries'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->FedexChannel->id = $id;
		if (!$this->FedexChannel->exists()) {
			throw new NotFoundException(__('Invalid fedexchannel'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FedexChannel->delete()) {
			$this->Session->setFlash('The fedexchannel has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The fedexchannel could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
 * admin_add method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	public function admin_generate_fedexchannels(){
		if($this->request->is('post')){
			$country_state_data = $this->FedexChannel->Country->find('first',array('conditions'=>array('country_code'=>'BD'),'limit'=>null));
			$fedexchannels = array();
			$newFedexChannelList = array();
			$i=0;
			
			foreach($country_state_data['State'] as $key=>$value){
				foreach($country_state_data['City'] as $key1=>$value1){
					
					if($value1['state_code'] == $value['state_code'])
					{
						$fedexchannels['FedexChannel'][$i]['country_code'] = 'BD';
						$fedexchannels['FedexChannel'][$i]['state_code'] = $value['state_code'];
						$fedexchannels['FedexChannel'][$i]['city_id'] = $value1['id'];
						$i++;	
					}
				}
			}
			$this->FedexChannel->create();		
			$this->FedexChannel->saveAll($fedexchannels['FedexChannel']);
			$this->Session->setFlash('FedexChannels has been Updated','default',array('class'=>'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function admin_add(){
		if($this->request->is('post')){
			$data = $this->request->data;
			if($this->FedexChannel->save($data)){
				$this->Session->setFlash('FedexChannels has been added','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Please try again.','default',array('class'=>'alert alert-warning'));
			}
			
		}
		$countries = $this->FedexChannel->Country->find('list',array('order'=>'name ASC'));
		$this->set(compact('countries'));
	}
}
