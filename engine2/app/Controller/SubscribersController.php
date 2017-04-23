<?php
App::uses('AppController', 'Controller');
/**
 * Subscribers Controller
 *
 * @property Subscriber $Subscriber
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SubscribersController extends AppController {

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
		$this->Subscriber->recursive = 0;
		$this->set('subscribers', $this->Paginator->paginate());
	}
 

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Subscriber->delete()) {
			$this->Session->setFlash('The subscriber has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The subscriber could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
