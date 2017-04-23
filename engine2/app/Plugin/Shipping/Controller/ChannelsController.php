<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * Channels Controller
 *
 * @property Channel $Channel
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ChannelsController extends ShippingAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $uses = array('Shipping.Channel','Shipping.Country','Shipping.State');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Channel->recursive = 0;
		if ($this->request->is('post')) {
			$searchText = addslashes($this->request->data['Channel']['keywords']);
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
							"Channel.price LIKE '%".$searchText."%'",
							"Channel.country_code LIKE '%".$searchText."%'",
							"Country.country_name LIKE '%".$searchText."%'"	
					
					)
				)
			);
		}
		/*$this->paginate = array(
		'contain' => array('Country'),
		'fields'=>array('Channel.*','Country.*','State.state_code','State.state_name'),
		'joins' => array(
		 
			array(
				'table' => 'states',
				'alias' => 'State',
				'type' => 'inner' ,
				'conditions'=> array(
				'Channel.country_code = State.country_code',
				'Channel.state_code = State.state_code'
				)
			)
		)
		);*/
		$this->set('channels', $this->Paginator->paginate());
	} 

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Channel->exists($id)) {
			throw new NotFoundException(__('Invalid channel'));
		}
		$options = array('conditions' => array('Channel.' . $this->Channel->primaryKey => $id));
		$this->set('channel', $this->Channel->find('first', $options));
	}


/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Channel->exists($id)) {
			throw new NotFoundException(__('Invalid channel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Channel->save($this->request->data)) {
				$this->Session->setFlash('The channel has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The channel could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Channel.' . $this->Channel->primaryKey => $id));
			$this->request->data = $this->Channel->find('first', $options);
		}
		
		$countries = $this->Country->find('list',array('conditions' => array('country_code'=>$this->request->data['Channel']['country_code'])));
		
		$states = $this->State->getStates($this->request->data['Channel']['country_code']);
		$this->set(compact('countries', 'states'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Channel->id = $id;
		if (!$this->Channel->exists()) {
			throw new NotFoundException(__('Invalid channel'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Channel->delete()) {
			$this->Session->setFlash('The channel has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The channel could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
	public function admin_generate_channels(){
		if($this->request->is('post')){
			$country_state_data = $this->Channel->Country->find('first',array('conditions'=>array('country_code'=>'SA'),'limit'=>null));
			$this->Channel->deleteAll(array('country_code'=>$country_state_data['Country']['country_code']),false);
			$channels = array();
			$newChannelList = array();
			$i=0;
			foreach($country_state_data['State'] as $key=>$value){
				if($value['state_code'] == $value['state_code']) {
					$channels['Channel'][$i]['country_code'] = 'SA';
					$channels['Channel'][$i]['state_code'] = $value['state_code'];
					$channels['Channel'][$i]['price'] = 0;
					$i++;	
				}
			}
			//die();
			$this->Channel->create();		
			$this->Channel->saveAll($channels['Channel']);
			$this->Session->setFlash('Channels has been Updated','default',array('class'=>'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function admin_add(){
		if($this->request->is('post')){
			$data = $this->request->data;
			if($this->Channel->save($data)){
				$this->Session->setFlash('Channels has been added','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Please try again.','default',array('class'=>'alert alert-warning'));
			}
			
		}
		$countries = $this->Channel->Country->find('list',array('order'=>'country_name ASC'));
		$this->set(compact('countries'));
	}
}
