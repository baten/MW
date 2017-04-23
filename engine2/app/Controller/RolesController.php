<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RolesController extends AppController {

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
		$this->Role->recursive = 0;
		if ($this->request->is('post')) {
		
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Role.title LIKE '%".$this->request->data['Role']['keywords']."%'"
					)
				)
			);
		}
		$this->set('roles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
		$this->set('role', $this->Role->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$permissions = json_encode($data['permission']);
			$data['Role']['accesslist'] = $permissions;//json_encode($data['permission']);
			unset($data['permission']);
			$this->Role->create();
			if ($this->Role->save($data)) {
				$this->Session->setFlash('The role has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The role could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$permissions = json_encode($data['permission']);
			$data['Role']['accesslist'] = $permissions;
			
			unset($data['permission']);
			if ($this->Role->save($data)) {
				$this->Session->setFlash('The role has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The role could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id),'recursive'=> -1);
			$data = $this->Role->find('first', $options);
			$data['Role']['accesslist'] = json_decode($data['Role']['accesslist'],true);
			
			$this->request->data = $data;
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
		$this->Role->id = $id;
		if (!$this->Role->exists()) {
			throw new NotFoundException(__('Invalid role'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Role->delete()) {
			$this->Session->setFlash('The role has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The role could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
