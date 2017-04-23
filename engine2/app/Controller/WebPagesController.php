<?php
App::uses('AppController', 'Controller');
/**
 * WebPages Controller
 *
 * @property WebPage $WebPage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WebPagesController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->WebPage->tablePrefix = 'english_';
			$this->WebPage->langsName = 'English';
		}else{
			$this->WebPage->langsName = 'Bengali';
		}
	
	}
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
		$this->WebPage->recursive = 0;
		if ($this->request->is('post')) {
		
			$this->paginate = array(
					'conditions'=>array(
							'OR'=>array(
									"WebPage.title LIKE '%".$this->request->data['WebPage']['keywords']."%'",
									"WebPage.description LIKE '%".$this->request->data['WebPage']['keywords']."%'",
							),
					)
			);
		} 
		$this->set('webPages', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->WebPage->exists($id)) {
			throw new NotFoundException(__('Invalid web page'));
		}
		$options = array('conditions' => array('WebPage.' . $this->WebPage->primaryKey => $id));
		$this->set('webPage', $this->WebPage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->WebPage->create();
			$datasource = $this->WebPage->getDataSource();
			try {
				$datasource->begin();
				if(!$this->WebPage->save($data)){
					throw new Exception();
				}
				$webPageId = $this->WebPage->id;
				$data['WebPage']['id'] = $webPageId;
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->WebPage->tablePrefix = 'english_';
				}else{
					$this->WebPage->tablePrefix = '';
				}
			
				if(!$this->WebPage->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('The web page has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The web page could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->WebPage->exists($id)) {
			throw new NotFoundException(__('Invalid web page'));
		}
		if ($this->request->is(array('post', 'put'))) {		
			$data = $this->request->data;
			// pr($data);die();
			if ($this->WebPage->save($data)) {
				$slugData = $this->WebPage->findById($id,array('WebPage.slug'));
				$updateableDataForOpposite = array();
				if($this->langsName == 'Bengali'){
					$this->WebPage->tablePrefix = 'english_';
				}else{
					$this->WebPage->tablePrefix = '';
					$updateableDataForOpposite['WebPage']['slug'] = $slugData['WebPage']['slug'];
					
				}
				if(!empty($updateableDataForOpposite)){
					$this->WebPage->updateData('WebPage', $updateableDataForOpposite, $id, $this->WebPage->tablePrefix);
				}
				
				
				$this->Session->setFlash('The web page has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The web page could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('WebPage.' . $this->WebPage->primaryKey => $id));
			$this->request->data = $this->WebPage->find('first', $options);
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
		$this->WebPage->id = $id;
		if (!$this->WebPage->exists()) {
			throw new NotFoundException(__('Invalid web page'));
		}
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->WebPage->getDataSource();
		try {
			$datasource->begin();
			if(!$this->WebPage->delete()){
				throw new Exception();
			}
		 
			if($this->langsName=='Bengali'){
				$this->WebPage->tablePrefix = 'english_';
			}else{
				$this->WebPage->tablePrefix = '';
			}
			$this->WebPage->id = $id;
			if(!$this->WebPage->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The web page has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The web page could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		 
		return $this->redirect(array('action' => 'index'));
	}
	
	
	
}
