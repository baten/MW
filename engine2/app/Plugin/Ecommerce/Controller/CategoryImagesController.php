<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * CategoryImages Controller
 *
 * @property CategoryImage $CategoryImage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoryImagesController extends EcommerceAppController {

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
		$this->CategoryImage->recursive = 0;
		$this->set('categoryImages', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->CategoryImage->exists($id)) {
			throw new NotFoundException(__('Invalid category image'));
		}
		$options = array('conditions' => array('CategoryImage.' . $this->CategoryImage->primaryKey => $id));
		$this->set('categoryImage', $this->CategoryImage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->CategoryImage->create();
			if ($this->CategoryImage->save($this->request->data)) {
				$this->Session->setFlash('The category image has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The category image could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->CategoryImage->exists($id)) {
			throw new NotFoundException(__('Invalid category image'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CategoryImage->save($this->request->data)) {
				$this->Session->setFlash('The category image has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The category image could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('CategoryImage.' . $this->CategoryImage->primaryKey => $id));
			$this->request->data = $this->CategoryImage->find('first', $options);
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
		$this->CategoryImage->id = $id;
		if (!$this->CategoryImage->exists()) {
			throw new NotFoundException(__('Invalid category image'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CategoryImage->delete()) {
			$this->Session->setFlash('The category image has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The category image could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
