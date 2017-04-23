<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * ShippingMethods Controller
 *
 * @property ShippingMethod $ShippingMethod
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ShippingMethodsController extends EcommerceAppController {

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
		$this->ShippingMethod->recursive = 0;
		$this->set('shippingMethods', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ShippingMethod->exists($id)) {
			throw new NotFoundException(__('Invalid shipping method'));
		}
		$options = array('conditions' => array('ShippingMethod.' . $this->ShippingMethod->primaryKey => $id));
		$this->set('shippingMethod', $this->ShippingMethod->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ShippingMethod->create();
			if ($this->ShippingMethod->save($this->request->data)) {
				$this->Session->setFlash('The shipping method has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The shipping method could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->ShippingMethod->exists($id)) {
			throw new NotFoundException(__('Invalid shipping method'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ShippingMethod->save($this->request->data)) {
				$this->Session->setFlash('The shipping method has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The shipping method could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('ShippingMethod.' . $this->ShippingMethod->primaryKey => $id));
			$this->request->data = $this->ShippingMethod->find('first', $options);
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
		$this->ShippingMethod->id = $id;
		if (!$this->ShippingMethod->exists()) {
			throw new NotFoundException(__('Invalid shipping method'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ShippingMethod->delete()) {
			$this->Session->setFlash('The shipping method has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The shipping method could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
