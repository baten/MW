<?php
App::uses('AppController', 'Controller');
/**
 * CurrencyValues Controller
 *
 * @property CurrencyValue $CurrencyValue
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CurrencyValuesController extends AppController {

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
		$currencyValues = $this->CurrencyValue->find('all');
		$this->set('currencyValues',$currencyValues);
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->CurrencyValue->exists($id)) {
			throw new NotFoundException(__('Invalid currency value'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CurrencyValue->save($this->request->data)) {
				$this->Session->setFlash('The currency value has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The currency value could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('CurrencyValue.' . $this->CurrencyValue->primaryKey => $id));
			$this->request->data = $this->CurrencyValue->find('first', $options);
		}
	}

  
}
