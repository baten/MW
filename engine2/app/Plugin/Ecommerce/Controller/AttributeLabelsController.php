<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * AttributeLabels Controller
 *
 * @property AttributeLabel $AttributeLabel
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AttributeLabelsController extends EcommerceAppController {

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
		$this->AttributeLabel->recursive = 0;
		$this->set('attributeLabels', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AttributeLabel->exists($id)) {
			throw new NotFoundException(__('Invalid attribute label'));
		}
		$options = array('conditions' => array('AttributeLabel.' . $this->AttributeLabel->primaryKey => $id));
		$this->set('attributeLabel', $this->AttributeLabel->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AttributeLabel->create();
			if ($this->AttributeLabel->save($this->request->data)) {
				$this->Session->setFlash('The attribute label has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The attribute label could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->AttributeLabel->exists($id)) {
			throw new NotFoundException(__('Invalid attribute label'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AttributeLabel->save($this->request->data)) {
				$this->Session->setFlash('The attribute label has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The attribute label could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('AttributeLabel.' . $this->AttributeLabel->primaryKey => $id));
			$this->request->data = $this->AttributeLabel->find('first', $options);
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
		$this->AttributeLabel->id = $id;
		if (!$this->AttributeLabel->exists()) {
			throw new NotFoundException(__('Invalid attribute label'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AttributeLabel->delete()) {
			$this->Session->setFlash('The attribute label has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The attribute label could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
