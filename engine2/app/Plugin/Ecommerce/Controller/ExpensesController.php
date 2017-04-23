<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Expenses Controller
 *
 * @property Expense $Expense
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ExpensesController extends EcommerceAppController {

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
		$this->Expense->recursive = 0;
        if ($this->request->is('post')) {
            $searchText = addslashes($this->request->data['Expense']['keywords']);
            $this->paginate = array(
                'conditions' => array(
                    'OR' => array(
                        "ExpenseTitle.title LIKE '%" . $searchText . "%'",
                        "Expense.date LIKE '%" . $searchText . "%'",
                        "Expense.id = '" . $searchText . "'"

                    )
                ),

            );
        }


		$this->set('expenses', $this->Paginator->paginate());

	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Expense->exists($id)) {
			throw new NotFoundException(__('Invalid expense'));
		}
		$options = array('conditions' => array('Expense.' . $this->Expense->primaryKey => $id));
		$this->set('expense', $this->Expense->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Expense->create();
			if ($this->Expense->save($this->request->data)) {
				$this->Session->setFlash('The expense has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The expense could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}

        $options = array('conditions' => array('ExpenseTitle.active' => 1));

        $expenseTitles = $this->Expense->ExpenseTitle->find('list',$options);
		$this->set(compact('expenseTitles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Expense->exists($id)) {
			throw new NotFoundException(__('Invalid expense'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Expense->save($this->request->data)) {
				$this->Session->setFlash('The expense has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The expense could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Expense.' . $this->Expense->primaryKey => $id));
			$this->request->data = $this->Expense->find('first', $options);
		}
		$expenseTitles = $this->Expense->ExpenseTitle->find('list');
		$this->set(compact('expenseTitles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Expense->id = $id;
		if (!$this->Expense->exists()) {
			throw new NotFoundException(__('Invalid expense'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Expense->delete()) {
			$this->Session->setFlash('The expense has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The expense could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
