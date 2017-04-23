<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * ProductOrderNotes Controller
 *
 * @property ProductOrderNote $ProductOrderNote
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductOrderNotesController extends EcommerceAppController {

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
		$this->ProductOrderNote->recursive = 0;
		$this->set('productOrderNotes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductOrderNote->exists($id)) {
			throw new NotFoundException(__('Invalid product order note'));
		}
		$options = array('conditions' => array('ProductOrderNote.' . $this->ProductOrderNote->primaryKey => $id));
		$this->set('productOrderNote', $this->ProductOrderNote->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductOrderNote->create();
			if ($this->ProductOrderNote->save($this->request->data)) {
				$this->Session->setFlash('The product order note has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The product order note could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$productOrders = $this->ProductOrderNote->ProductOrder->find('list');
		$this->set(compact('productOrders'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductOrderNote->exists($id)) {
			throw new NotFoundException(__('Invalid product order note'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductOrderNote->save($this->request->data)) {
				$this->Session->setFlash('The product order note has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The product order note could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('ProductOrderNote.' . $this->ProductOrderNote->primaryKey => $id));
			$this->request->data = $this->ProductOrderNote->find('first', $options);
		}
		$productOrders = $this->ProductOrderNote->ProductOrder->find('list');
		$this->set(compact('productOrders'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductOrderNote->id = $id;
		if (!$this->ProductOrderNote->exists()) {
			throw new NotFoundException(__('Invalid product order note'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProductOrderNote->delete()) {
			$this->Session->setFlash('The product order note has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The product order note could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
