<?php
App::uses('AppController', 'Controller');
/**
 * Partners Controller
 *
 * @property Partner $Partner
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PartnersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Partner->recursive = 0;
		if ($this->request->is('post')) {                 
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Partner.name LIKE '%".$this->request->data['Partner']['keywords']."%'",
					)
				),
				'order'=>array('order'=>'ASC')
			);
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
		$this->set('partners', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Partner->exists($id)) {
			throw new NotFoundException(__('Invalid partner'));
		}
		$options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
		$this->set('partner', $this->Partner->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Partner->create();
			if ($this->Partner->save($this->request->data)) {
				$this->Session->setFlash('The partner has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The partner could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Partner->exists($id)) {
			throw new NotFoundException(__('Invalid partner'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Partner->save($this->request->data)) {
				$this->Session->setFlash('The partner has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The partner could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
			$this->request->data = $this->Partner->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Partner->id = $id;
		if (!$this->Partner->exists()) {
			throw new NotFoundException(__('Invalid partner'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Partner->delete()) {
			$this->Session->setFlash('The partner has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The partner could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Partner->recursive = 0;
		if ($this->request->is('post')) {                 
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Partner.name LIKE '%".$this->request->data['Partner']['keywords']."%'",
					)
				),
				'order'=>array('order'=>'ASC')
			);
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
		$this->set('partners', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Partner->exists($id)) {
			throw new NotFoundException(__('Invalid partner'));
		}
		$options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
		$this->set('partner', $this->Partner->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if(isset($data['Partner']['image']) && $data['Partner']['image']['error'] == 0){
				$data['Partner']['image_extension'] =  $this->Uploader->getFileExtension($data['Partner']['image']);
			}
			$this->Partner->create();
			if ($this->Partner->save($data)) {

				$image_id = $this->Partner->getInsertId();
				if(isset($data['Partner']['image']) && $data['Partner']['image']['error'] == 0){
					$this->Uploader->upload($data['Partner']['image'], $image_id, $data['Partner']['image_extension'], 'partners',$fileOrImage = null, $height = null, $width = null, $oldfile = null );
				}
				

				$this->Session->setFlash('The partner has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The partner could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->Partner->exists($id)) {
			throw new NotFoundException(__('Invalid partner'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if(isset($data['Partner']['image']) && $data['Partner']['image']['error'] == 0){
				$data['Partner']['image_extension'] = $this->Uploader->getFileExtension($data['Partner']['image']);
				
				$this->Uploader->upload($data['Partner']['image'], $id, $data['Partner']['image_extension'], 'partners',$fileOrImage = null, $height = null, $width = null, $oldfile = null );
			}
			if ($this->Partner->save($data)) {
				$this->Session->setFlash('The partner has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The partner could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
			$this->request->data = $this->Partner->find('first', $options);
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
		$this->Partner->id = $id;
		if (!$this->Partner->exists()) {
			throw new NotFoundException(__('Invalid partner'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Partner->delete()) {
			$this->Session->setFlash('The partner has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The partner could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
