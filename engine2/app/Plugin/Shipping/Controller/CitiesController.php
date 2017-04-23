<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CitiesController extends ShippingAppController {

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
	public function admin_index($country_code=NULL, $state_code=NULL) {
		
		if (empty($country_code) && empty($state_code)) {
			//throw new NotFoundException(__('Invalid Country'));
			return $this->redirect(array('controller'=>'countries','action' => 'index'));
		}
		
		if ($this->request->is('post')) {
			$this->paginate = array(
					'conditions'=>array(
							'OR'=>array(
									"City.city_name LIKE '%".$this->request->data['City']['keywords']."%'" 
							)
					)
			);
		}
		
		$this->City->recursive = -1;
		$this->paginate = array(
					'conditions'=>array(
									"City.country_code"=> $country_code,
									"City.state_code"=> $state_code
					)
		);
		
		//pr($this->Paginator->paginate()); exit;
				
		
		$this->set('cities', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->City->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
		$this->set('city', $this->City->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->City->create();
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash('The city has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The city could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$countries = $this->City->Country->find('list');
		$this->set(compact('countries'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->City->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash('The city has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The city could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
			$this->request->data = $this->City->find('first', $options);
		}
		
	    $countries = $this->City->Country->find('list');
		$this->set(compact('countries'));
		
		//debug($countries);
		
		//$states = $this->State->Country->find('list');
		//$this->set(compact('countries'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->City->delete()) {
			$this->Session->setFlash('The city has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The city could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
