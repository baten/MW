<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * DhlChannels Controller
 *
 * @property DhlChannel $DhlChannel
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DhlChannelsController extends ShippingAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Shipping.DhlChannel','Shipping.State');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->DhlChannel->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
							"DhlChannel.price LIKE '%".$this->request->data['DhlChannel']['keywords']."%'",
							"DhlChannel.country_code LIKE '%".$this->request->data['DhlChannel']['keywords']."%'",
							"Country.country_name LIKE '%".$this->request->data['DhlChannel']['keywords']."%'"			
					
					)
				)
			);
		}
		$this->set('DhlChannels', $this->Paginator->paginate());
	} 

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DhlChannel->exists($id)) {
			throw new NotFoundException(__('Invalid DhlChannel'));
		}
		$options = array('conditions' => array('DhlChannel.' . $this->DhlChannel->primaryKey => $id));
		$this->set('DhlChannel', $this->DhlChannel->find('first', $options));
	}


/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->DhlChannel->exists($id)) {
			throw new NotFoundException(__('Invalid DhlChannel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DhlChannel->save($this->request->data)) {
				$this->Session->setFlash('The DhlChannel has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The DhlChannel could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('DhlChannel.' . $this->DhlChannel->primaryKey => $id));
			$this->request->data = $this->DhlChannel->find('first', $options);
		}
		
		$countries = $this->DhlChannel->Country->find('list',array('conditions' => array('country_code'=>$this->request->data['DhlChannel']['country_code'])));
		
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
		$this->DhlChannel->id = $id;
		if (!$this->DhlChannel->exists()) {
			throw new NotFoundException(__('Invalid DhlChannel'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DhlChannel->delete()) {
			$this->Session->setFlash('The DhlChannel has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The DhlChannel could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
	public function admin_generate_DhlChannels(){
		if($this->request->is('post')){
			$country_state_data = $this->DhlChannel->Country->find('first',array('conditions'=>array('country_code'=>'BD'),'limit'=>null));
			$DhlChannels = array();
			$newDhlChannelList = array();
			$i=0;
			
			foreach($country_state_data['State'] as $key=>$value){
				foreach($country_state_data['City'] as $key1=>$value1){
					
					if($value1['state_code'] == $value['state_code'])
					{
						$DhlChannels['DhlChannel'][$i]['country_code'] = 'BD';
						$DhlChannels['DhlChannel'][$i]['state_code'] = $value['state_code'];
						$DhlChannels['DhlChannel'][$i]['city_id'] = $value1['id'];
						$i++;	
					}
				}
			}
			$this->DhlChannel->create();		
			$this->DhlChannel->saveAll($DhlChannels['DhlChannel']);
			$this->Session->setFlash('DhlChannels has been Updated','default',array('class'=>'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function admin_add(){
		if($this->request->is('post')){
			$data = $this->request->data;
			if($this->DhlChannel->save($data)){
				$this->Session->setFlash('DhlChannels has been added','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Please try again.','default',array('class'=>'alert alert-warning'));
			}
			
		}
		$countries = $this->DhlChannel->Country->find('list',array('order'=>'name ASC'));
		$this->set(compact('countries'));
	}
}
