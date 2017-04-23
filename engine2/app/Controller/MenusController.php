<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MenusController extends AppController {
	
	public $uses = array('Menu','WebPage');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Menu->tablePrefix = 'english_';
			$this->WebPage->tablePrefix = 'english_';
			$this->Menu->langsName = 'English';
		}else{
			$this->Menu->langsName = 'Bengali';
		}
	
	}

/**
 * Components
 *
 * @var array
 */
	
	public $components = array('Paginator', 'Session');
	
	public $helpers = array('Tree');

/**
 * admin_index method
 *
 * @return void
 */
	 public function admin_index() {
		//
		//$this->Menu->recursive = 0;
		//$this->set('menus', $this->Paginator->paginate());
		$menu_arrays = array();
		$cond = "";
		if ($this->request->is('post')) {
			$cond = array('OR'=>array( "Menu.title LIKE '%".$this->request->data['Menu']['keywords']."%'"));
		}
		foreach($this->menu_locations as $k=>$v){
			
			$menu_arrays[$v] = $this->Menu->find(
				'all',
				array(
					'joins' =>array(
						array(
							'table' => $this->Menu->tablePrefix .'menus',
							'alias' => 'PMenu',
							'type' => 'LEFT',
							'foreignKey' => false,
							'conditions'=> array('Menu.parent_id = PMenu.id')
						)
					),
					'fields'=>array(
						'Menu.*',
						'PMenu.title'
					),
					'conditions'=>array('Menu.location'=>$k,$cond),
					'order'=>array('Menu.parent_id'=>'ASC')
					)
				);
			//pr($menu_arrays);
		}
		
		
		$web_pages = ClassRegistry::init('WebPage')->find('list',array('fields'=>array('slug','title')));
		$this->set(compact('web_pages','menu_arrays'));
	} 
	

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			
			$data = $this->request->data;
			$this->Menu->create();
			if($data['Menu']['type'] == 'content'){
				$data['Menu']['link_data'] = $data['Menu']['web_pages'];
			}
			
			if($data['Menu']['type']  == 'functional'){
				$data['Menu']['is_deleteable'] = 'yes,no';
			}else{
				$data['Menu']['is_deleteable'] = 'yes,yes';
			}
			
			
			unset($data['Menu']['web_pages']);
			$datasource = $this->Menu->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Menu->save($data)){
					throw new Exception();
				}
				$menuId = $this->Menu->id;
				$data['Menu']['id'] = $menuId;
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Menu->tablePrefix = 'english_';
				}else{
					$this->Menu->tablePrefix = '';
				}
					
				if(!$this->Menu->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('The menu has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The menu could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
		$parentMenus = $this->Menu->find('list');
		$this->set(compact('parentMenus'));
		$this->set('webpages',$this->getWebPages());
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$data = $this->request->data;
			if(isset($data['Menu']['type'])){
				if($data['Menu']['type'] == 'content'){
					$data['Menu']['link_data'] = $data['Menu']['web_pages'];
				}
				unset($data['Menu']['web_pages']);
				
				if($data['Menu']['type']  == 'functional'){
					$data['Menu']['is_deleteable'] = 'yes,no';
				}else{
					$data['Menu']['is_deleteable'] = 'yes,yes';
				}
			}
				
			
			if ($this->Menu->save($data)) {
				$this->Session->setFlash('The menu has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The menu could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
		$parentMenus = $this->Menu->find('list',array('conditions'=>array('id !=' => $id )));
		$this->set(compact('parentMenus'));
		$this->set('webpages',$this->getWebPages());
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->Menu->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Menu->delete()){
				throw new Exception();
			}
				
			if($this->langsName == 'Bengali'){
				$this->Menu->tablePrefix = 'english_';
			}else{
				$this->Menu->tablePrefix = '';
			}
			$this->Menu->id = $id;
			if(!$this->Menu->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The menu has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The menu could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
			
		return $this->redirect(array('action' => 'index'));
	}
	
	// menu sorting.
	
	public function admin_sort_menu(){
		if ($this->request->is('post')) {
			
			$data = $this->request->data;
			//pr($data);die();
			$i = 1;
			$orderData = array();
			foreach ($data['order'] AS $datum){
				$orderData[$i]['Menu']['id'] = $datum;
				$orderData[$i]['Menu']['order'] = $i;
				$i++;
				
			}
			
			$datasource = $this->Menu->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Menu->saveMany($orderData)){
					throw new Exception();
				}
				  
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Menu->tablePrefix = 'english_';
				}else{
					$this->Menu->tablePrefix = '';
				}
					
				if(!$this->Menu->saveMany($orderData)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('These menu has been sorted.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('These menu could not be sorted. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
		
		$menu_arrays = array();
		foreach($this->menu_locations as $k=>$v){
			$menu_arrays[$v] = $this->Menu->find(
			'threaded',
			array(
				'recursive' => -1,
				'fields' => array(
					'id',
					'parent_id',
					'title',
					'slug'
				),
				'conditions'=>array('Menu.location'=>$k),
				'order' => array('order'=>'ASC')
				)
			);
		}
			
		
		$web_pages = ClassRegistry::init('WebPage')->find('list');
		$this->set(compact('web_pages','menu_arrays'));
	}
	
	
	//get web_page list
	private function getWebPages(){
		return ClassRegistry::init('WebPage')->find('list',array('fields'=>array('slug','title')));
	}
}
