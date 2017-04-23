<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * RelatedProducts Controller
 *
 * @property RelatedProduct $RelatedProduct
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RelatedProductsController extends EcommerceAppController {

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
		$this->RelatedProduct->recursive = 0;
		$this->set('relatedProducts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RelatedProduct->exists($id)) {
			throw new NotFoundException(__('Invalid related product'));
		}
		$options = array('conditions' => array('RelatedProduct.' . $this->RelatedProduct->primaryKey => $id));
		$this->set('relatedProduct', $this->RelatedProduct->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RelatedProduct->create();
			if ($this->RelatedProduct->save($this->request->data)) {
				$this->Session->setFlash('The related product has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The related product could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$products = $this->RelatedProduct->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->RelatedProduct->exists($id)) {
			throw new NotFoundException(__('Invalid related product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RelatedProduct->save($this->request->data)) {
				$this->Session->setFlash('The related product has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The related product could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('RelatedProduct.' . $this->RelatedProduct->primaryKey => $id));
			$this->request->data = $this->RelatedProduct->find('first', $options);
		}
		$products = $this->RelatedProduct->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->RelatedProduct->id = $id;
		if (!$this->RelatedProduct->exists()) {
			throw new NotFoundException(__('Invalid related product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RelatedProduct->delete()) {
			$this->Session->setFlash('The related product has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The related product could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
