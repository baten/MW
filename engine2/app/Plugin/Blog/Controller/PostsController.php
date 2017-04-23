<?php
App::uses('BlogAppController', 'Blog.Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PostsController extends BlogAppController {

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
		$this->Post->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
					'conditions'=>array(
							'OR'=>array(
									"Post.title LIKE '%".$this->request->data['Post']['keywords']."%'"
							)
					)
			);
		}
		$this->set('posts', $this->Paginator->paginate());
		
		$categories = ClassRegistry::init('Blog.BlogCategory')->find('list');
		$this->set('categories',$categories);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$data['Post']['user'] = $this->Auth->user('id');
			$data['Post']['categories'] = json_encode($data['Post']['categories']);
			
			$this->Post->create();
			if ($this->Post->save($data)) {
				$this->Session->setFlash('The post has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The post could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
		
		$categories = ClassRegistry::init('Blog.BlogCategory')->find('list');
		$this->set('categories',$categories);
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$data['Post']['categories'] = json_encode($data['Post']['categories']);
			
			if ($this->Post->save($data)) {
				$this->Session->setFlash('The post has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The post could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}
		
		$categories = ClassRegistry::init('Blog.BlogCategory')->find('list');
		$this->set('categories',$categories);
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete()) {
			$this->Session->setFlash('The post has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The post could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
