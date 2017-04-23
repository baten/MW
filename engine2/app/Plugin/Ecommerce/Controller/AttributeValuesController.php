<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * AttributeValues Controller
 *
 * @property AttributeValue $AttributeValue
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AttributeValuesController extends EcommerceAppController {

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
		$this->AttributeValue->recursive = 0;
		$this->set('attributeValues', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AttributeValue->exists($id)) {
			throw new NotFoundException(__('Invalid attribute value'));
		}
		$options = array('conditions' => array('AttributeValue.' . $this->AttributeValue->primaryKey => $id));
		$this->set('attributeValue', $this->AttributeValue->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AttributeValue->create();
			if ($this->AttributeValue->save($this->request->data)) {
				$this->Session->setFlash('The attribute value has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The attribute value could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
		$attributes = $this->AttributeValue->Attribute->find('list');
		$this->set(compact('attributes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->AttributeValue->exists($id)) {
			throw new NotFoundException(__('Invalid attribute value'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AttributeValue->save($this->request->data)) {
				$this->Session->setFlash('The attribute value has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The attribute value could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('AttributeValue.' . $this->AttributeValue->primaryKey => $id));
			$this->request->data = $this->AttributeValue->find('first', $options);
		}
		$attributes = $this->AttributeValue->Attribute->find('list');
		$this->set(compact('attributes'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AttributeValue->id = $id;
		if (!$this->AttributeValue->exists()) {
			throw new NotFoundException(__('Invalid attribute value'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AttributeValue->delete()) {
			$this->Session->setFlash('The attribute value has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The attribute value could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
