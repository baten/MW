<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * States Controller
 *
 * @property State $State
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class StatesController extends ShippingAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($country_code=NULL) {
		
		if (empty($country_code)) {
			//throw new NotFoundException(__('Invalid Country'));
			return $this->redirect(array('controller'=>'countries','action' => 'index'));
		}
		
		if ($this->request->is('post')) {
			$this->paginate = array(
					'conditions'=>array(
							'OR'=>array(
									"State.city_name LIKE '%".$this->request->data['State']['keywords']."%'" 
							)
					)
			);
		}
		
		$this->State->recursive = -1;
		$this->paginate = array(
					'conditions'=>array(
									"State.country_code"=> $country_code									
					)
		);
		$this->set('states', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->State->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
		$this->set('city', $this->State->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($country_code = null) {
		if ($this->request->is('post')) {
			$this->State->create();
			$this->request->data['State']['country_code'] = $country_code;
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash('The State has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index',$country_code));
			} else {
				$this->Session->setFlash('The State could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
	public function admin_edit($id = null,$country_code = null) {
		if (!$this->State->exists($id)) {
			throw new NotFoundException(__('Invalid State'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash('The city has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index',$country_code));
			} else {
				$this->Session->setFlash('The State could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$this->State->recursive=-1;
			$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
			$this->request->data = $this->State->find('first', $options);
			
		}
		$countries = $this->State->Country->find('list');		
		$this->set(compact('countries'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null,$country_code) {
		$this->State->id = $id;
		if (!$this->State->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->State->delete()) {
			$this->Session->setFlash('The city has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The city could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index',$country_code));
	}
}
