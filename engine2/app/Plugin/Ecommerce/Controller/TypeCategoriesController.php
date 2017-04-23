<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * TypeCategories Controller
 *
 * @property TypeCategory $TypeCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TypeCategoriesController extends EcommerceAppController {

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
		$this->TypeCategory->recursive = 0;
		$this->set('typeCategories', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->TypeCategory->exists($id)) {
			throw new NotFoundException(__('Invalid type category'));
		}
		$options = array('conditions' => array('TypeCategory.' . $this->TypeCategory->primaryKey => $id));
		$this->set('typeCategory', $this->TypeCategory->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->TypeCategory->create();
			if ($this->TypeCategory->save($this->request->data)) {
				$this->Session->setFlash('The type category has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The type category could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$types = $this->TypeCategory->Type->find('list');
		$categories = $this->TypeCategory->Category->find('list');
		$this->set(compact('types', 'categories'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->TypeCategory->exists($id)) {
			throw new NotFoundException(__('Invalid type category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TypeCategory->save($this->request->data)) {
				$this->Session->setFlash('The type category has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The type category could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('TypeCategory.' . $this->TypeCategory->primaryKey => $id));
			$this->request->data = $this->TypeCategory->find('first', $options);
		}
		$types = $this->TypeCategory->Type->find('list');
		$categories = $this->TypeCategory->Category->find('list');
		$this->set(compact('types', 'categories'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->TypeCategory->id = $id;
		if (!$this->TypeCategory->exists()) {
			throw new NotFoundException(__('Invalid type category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TypeCategory->delete()) {
			$this->Session->setFlash('The type category has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The type category could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
