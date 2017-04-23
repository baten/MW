<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * DpexChannels Controller
 *
 * @property DpexChannel $DpexChannel
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DpexChannelsController extends ShippingAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Shipping.DpexChannel','Shipping.State');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->DpexChannel->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(					
					'OR'=>array(
							"DpexChannel.price LIKE '%".$this->request->data['DpexChannel']['keywords']."%'",
							"DpexChannel.country_code LIKE '%".$this->request->data['DpexChannel']['keywords']."%'",
							"Country.country_name LIKE '%".$this->request->data['DpexChannel']['keywords']."%'"			
					
					)
				)
			);
		}
		$this->set('DpexChannels', $this->Paginator->paginate());
	} 

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DpexChannel->exists($id)) {
			throw new NotFoundException(__('Invalid DpexChannel'));
		}
		$options = array('conditions' => array('DpexChannel.' . $this->DpexChannel->primaryKey => $id));
		$this->set('DpexChannel', $this->DpexChannel->find('first', $options));
	}


/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->DpexChannel->exists($id)) {
			throw new NotFoundException(__('Invalid DpexChannel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DpexChannel->save($this->request->data)) {
				$this->Session->setFlash('The DpexChannel has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The DpexChannel could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('DpexChannel.' . $this->DpexChannel->primaryKey => $id));
			$this->request->data = $this->DpexChannel->find('first', $options);
		}
		
		$countries = $this->DpexChannel->Country->find('list',array('conditions' => array('country_code'=>$this->request->data['DpexChannel']['country_code'])));
		
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
		$this->DpexChannel->id = $id;
		if (!$this->DpexChannel->exists()) {
			throw new NotFoundException(__('Invalid DpexChannel'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DpexChannel->delete()) {
			$this->Session->setFlash('The DpexChannel has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The DpexChannel could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
	public function admin_generate_DpexChannels(){
		if($this->request->is('post')){
			$country_state_data = $this->DpexChannel->Country->find('first',array('conditions'=>array('country_code'=>'BD'),'limit'=>null));
			$DpexChannels = array();
			$newDpexChannelList = array();
			$i=0;
			
			foreach($country_state_data['State'] as $key=>$value){
				foreach($country_state_data['City'] as $key1=>$value1){
					
					if($value1['state_code'] == $value['state_code'])
					{
						$DpexChannels['DpexChannel'][$i]['country_code'] = 'BD';
						$DpexChannels['DpexChannel'][$i]['state_code'] = $value['state_code'];
						$DpexChannels['DpexChannel'][$i]['city_id'] = $value1['id'];
						$i++;	
					}
				}
			}
			$this->DpexChannel->create();		
			$this->DpexChannel->saveAll($DpexChannels['DpexChannel']);
			$this->Session->setFlash('DpexChannels has been Updated','default',array('class'=>'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function admin_add(){
		if($this->request->is('post')){
			$data = $this->request->data;
			if($this->DpexChannel->save($data)){
				$this->Session->setFlash('DpexChannels has been added','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Please try again.','default',array('class'=>'alert alert-warning'));
			}
			
		}
		$countries = $this->DpexChannel->Country->find('list',array('order'=>'name ASC'));
		$this->set(compact('countries'));
	}
}
