<?php
App::uses('AppController', 'Controller');

class DashboardsController extends AppController {

	public $uses = array('WebPage','Menu','User','Ecommerce.Product');

	public function admin_index(){
		//web pages
		$web_pages = $this->WebPage->find('count');
		$web_links = $this->Menu->find('count');
		$this->set(compact('web_pages','web_links'));
		//blog
		//$blog_posts = $this->Post->find('count');
		//$blog_categories = $this->BlogCategory->find('count');
		//$this->set(compact('blog_posts','blog_categories'));
		//ecommerce
		$products = $this->Product->find('count');
		//$product_brands = $this->Brand->find('count');
		$product_categoies = ClassRegistry::init('Ecommerce.Category')->find('count');
		
		//$stores = $this->Store->find('count');
		
		$this->set(compact('products','product_categoies'));
		
		//users
		$users = $this->User->find('count');
		$this->set(compact('users'));
	}
	

	public function index(){
		
	}
	

	
}
