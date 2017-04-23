<?php
App::uses('AppController', 'Controller');
/**
 * SubscriberNotificationDetails Controller
 *
 * @property SubscriberNotificationDetail $SubscriberNotificationDetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SubscriberNotificationDetailsController extends AppController {

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
		$this->SubscriberNotificationDetail->recursive = 0;
		$this->set('subscriberNotificationDetails', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->SubscriberNotificationDetail->exists($id)) {
			throw new NotFoundException(__('Invalid subscriber notification detail'));
		}
		$options = array('conditions' => array('SubscriberNotificationDetail.' . $this->SubscriberNotificationDetail->primaryKey => $id));
		$this->set('subscriberNotificationDetail', $this->SubscriberNotificationDetail->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SubscriberNotificationDetail->create();
			if ($this->SubscriberNotificationDetail->save($this->request->data)) {
				$this->Session->setFlash('The subscriber notification detail has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The subscriber notification detail could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$subscribers = $this->SubscriberNotificationDetail->Subscriber->find('list');
		$this->set(compact('subscribers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->SubscriberNotificationDetail->exists($id)) {
			throw new NotFoundException(__('Invalid subscriber notification detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SubscriberNotificationDetail->save($this->request->data)) {
				$this->Session->setFlash('The subscriber notification detail has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The subscriber notification detail could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('SubscriberNotificationDetail.' . $this->SubscriberNotificationDetail->primaryKey => $id));
			$this->request->data = $this->SubscriberNotificationDetail->find('first', $options);
		}
		$subscribers = $this->SubscriberNotificationDetail->Subscriber->find('list');
		$this->set(compact('subscribers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->SubscriberNotificationDetail->id = $id;
		if (!$this->SubscriberNotificationDetail->exists()) {
			throw new NotFoundException(__('Invalid subscriber notification detail'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SubscriberNotificationDetail->delete()) {
			$this->Session->setFlash('The subscriber notification detail has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The subscriber notification detail could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
