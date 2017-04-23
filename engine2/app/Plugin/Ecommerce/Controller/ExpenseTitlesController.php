<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * ExpenseTitles Controller
 *
 * @property ExpenseTitle $ExpenseTitle
 * @property PaginatorComponent $Paginator
 * @property nComponent $n
 * @property SessionComponent $Session
 */
class ExpenseTitlesController extends EcommerceAppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Paginator');

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
		$this->ExpenseTitle->recursive = 0;
		$this->set('expenseTitles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ExpenseTitle->exists($id)) {
			throw new NotFoundException(__('Invalid expense title'));
		}
		$options = array('conditions' => array('ExpenseTitle.' . $this->ExpenseTitle->primaryKey => $id));
		$this->set('expenseTitle', $this->ExpenseTitle->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ExpenseTitle->create();
			if ($this->ExpenseTitle->save($this->request->data)) {
				$this->Session->setFlash('The expense title has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The expense title could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->ExpenseTitle->exists($id)) {
			throw new NotFoundException(__('Invalid expense title'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ExpenseTitle->save($this->request->data)) {
				$this->Session->setFlash('The expense title has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The expense title could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('ExpenseTitle.' . $this->ExpenseTitle->primaryKey => $id));
			$this->request->data = $this->ExpenseTitle->find('first', $options);
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
		$this->ExpenseTitle->id = $id;
		if (!$this->ExpenseTitle->exists()) {
			throw new NotFoundException(__('Invalid expense title'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ExpenseTitle->delete()) {
			$this->Session->setFlash('The expense title has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The expense title could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
