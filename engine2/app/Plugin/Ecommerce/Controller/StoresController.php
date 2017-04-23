<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Stores Controller
 *
 * @property Store $Store
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class StoresController extends EcommerceAppController {

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
		$this->Store->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Store.title LIKE '%".$this->request->data['Store']['keywords']."%'"
					)
				)
			);
		}
		$this->set('stores', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Store->exists($id)) {
			throw new NotFoundException(__('Invalid store'));
		}
		$options = array('conditions' => array('Store.' . $this->Store->primaryKey => $id));
		$this->set('store', $this->Store->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Store->create();
			if ($this->Store->save($this->request->data)) {
				$this->Session->setFlash('The store has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The store could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Store->exists($id)) {
			throw new NotFoundException(__('Invalid store'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Store->save($this->request->data)) {
				$this->Session->setFlash('The store has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The store could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Store.' . $this->Store->primaryKey => $id));
			$this->request->data = $this->Store->find('first', $options);
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
		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			throw new NotFoundException(__('Invalid store'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Store->delete()) {
			$this->Session->setFlash('The store has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The store could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
