<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * Countries Controller
 *
 * @property Country $Country
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CountriesController extends ShippingAppController {

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
	public function admin_index() {
		$this->Country->recursive = 0;
		if ($this->request->is('post')) {
		
			$this->paginate = array(
					'conditions'=>array(
							'OR'=>array(
									"Country.country_name LIKE '%".$this->request->data['Country']['keywords']."%'",
									"Country.country_code LIKE '%".$this->request->data['Country']['keywords']."%'"
							)
					)
			);
		}
		//echo "<pre>";
		//pr($this->Paginator->paginate());
		//die();
		$this->set('countries', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Country->exists($id)) {
			throw new NotFoundException(__('Invalid country'));
		}
		$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
		$this->set('country', $this->Country->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Country->create();
			$this->request->data['Country']['country_code'] = $this->request->data['Country']['code'];
			//debug($this->request->data); exit;
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash('The country has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The country could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->Country->exists($id)) {
			throw new NotFoundException(__('Invalid country'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash('The country has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The country could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('recursive' => -1, 'conditions' => array('Country.' . $this->Country->primaryKey => $id));
			
			$this->request->data = $this->Country->find('first', $options);
			
			//pr($this->request->data);
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
		$this->Country->id = $id;
		if (!$this->Country->exists()) {
			throw new NotFoundException(__('Invalid country'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Country->delete()) {
			$this->Session->setFlash('The country has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The country could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
