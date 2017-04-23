<?php
App::uses('BlogAppController', 'Blog.Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SitesController extends BlogAppController {

public $components = array('RequestHandler');

	public $uses = array(
		'Blog.Category',
		'Blog.Post',
		'User'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index(){
		$this->render('json_render');
	}

	//get web page by id
	public function blog_post_by_id($id){
		$data = $this->Post->find('all',array(
			'conditions'=>array(
				'id' => $id
			)
		));
		$this->set(
				array(
					'_serialize',
					'data' => array('singlePage'=>$data),
					'_jsonp' => true
		
				)
		);
		$this->render('json_render');
	}
	
	//blog categories
	public function blog_categories(){
		$data = $this->Category->find(
			'list',
			array(
				'fields' => array('id','title'),
				'conditions' => array('Category.status' => 'active')		
			)
		);
		
		
		$this->set(
			array(
				'_serialize',
				'data' => array('blogCategories'=>$data),
				'_jsonp' => true
			)
		);
		$this->render('json_render');
	}
	
	//blog home list
	//latest posts
	public function blog_default_list($category_id = null){
		if($category_id == null){
			$data = $this->Post->find(
				'all',
				array(
					'conditions' => array('Post.status' => 'active'),
					'order' => array('created'=> 'asc'),
					'limit' => 5
				)
			);
		}else{
			$data = $this->Post->find(
				'all',
				array(
					'conditions' => array('Post.status' => 'active','Post.categories LIKE' => '%'. $category_id . '%',),
					'order' => array('created'=> 'asc'),
					'limit' => 5
				)
			);
		}
		
		$users = $this->User->find('list',array('fields'=>array('id','personal_details')));
	
		$this->set(
			array(
				'_serialize',
				'data' => array('blogPostDefaultList'=>$data,'users'=>$users),
				'_jsonp' => true
			)
		);
		$this->render('json_render');
	}
	
	
	
	//latest posts
	public function blog_latest_post(){
		$data = $this->Post->find(
			'list',
			array(
				'fields' => array('id','title'),
				'conditions' => array('Post.status' => 'active'),
				'order' => array('created'=> 'asc'),
				'limit' => 10
			)
		);
	
		$this->set(
			array(
				'_serialize',
				'data' => array('blogLatestPost'=>$data),
				'_jsonp' => true
			)
		);
		$this->render('json_render');
	}
	
	
	//single posts
	public function blog_single_post($id){
		$data = $this->Post->find(
			'all',
			array(
				'conditions' => array('Post.status' => 'active','Post.id'=>$id),
			)
		);
	
		$users = $this->User->find('list',array('fields'=>array('id','personal_details')));
		$this->set(
			array(
				'_serialize',
				'data' => array('blogPostDefaultList'=>$data,'users'=>$users),
				'_jsonp' => true
			)
		);
		$this->render('json_render');
	}
	
	
	public function beforeRender(){
		$this->response->header('Access-Control-Allow-Origin', '*');
	}
}
