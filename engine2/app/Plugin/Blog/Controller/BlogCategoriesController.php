<?php
App::uses('BlogAppController', 'Blog.Controller');
/**
 * Categories Controller
 *
 * @property BlogCategory $BlogCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BlogCategoriesController extends BlogAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
	public $uses = array('Blog.BlogCategory','Blog.Post');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->BlogCategory->recursive = 0;
		
		if ($this->request->is('post')) {
			$this->paginate = array(
					'conditions'=>array(
							'OR'=>array(
									"BlogCategory.title LIKE '%".$this->request->data['BlogCategory']['keywords']."%'"
							)
					)
			);
		}
		$this->set('categories', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->BlogCategory->exists($id)) {
			throw new NotFoundException(__('Invalid BlogCategory'));
		}
		$options = array('conditions' => array('BlogCategory.' . $this->BlogCategory->primaryKey => $id));
		$this->set('BlogCategory', $this->BlogCategory->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BlogCategory->create();
			if ($this->BlogCategory->save($this->request->data)) {
				$this->Session->setFlash('The BlogCategory has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The BlogCategory could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
		$parentCategories = $this->BlogCategory->find('list');
		$this->set(compact('parentCategories'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->BlogCategory->exists($id)) {
			throw new NotFoundException(__('Invalid BlogCategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BlogCategory->save($this->request->data)) {
				$this->Session->setFlash('The BlogCategory has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The BlogCategory could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('BlogCategory.' . $this->BlogCategory->primaryKey => $id));
			$this->request->data = $this->BlogCategory->find('first', $options);
		}
		$parentCategories = $this->BlogCategory->find('list',array('conditions'=>array('id !=' => $id)));
		$this->set(compact('parentCategories'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->BlogCategory->id = $id;
		if (!$this->BlogCategory->exists()) {
			throw new NotFoundException(__('Invalid BlogCategory'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BlogCategory->delete()) {
			
			//$this->Post->saveField('');
			$this->Session->setFlash('The BlogCategory has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The BlogCategory could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
