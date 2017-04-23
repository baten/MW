<?php
App::uses('AppController', 'Controller');
/**
 * WebPageDetails Controller
 *
 * @property WebPageDetail $WebPageDetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WebPageDetailsController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->WebPageDetail->tablePrefix = 'english_';
			$this->WebPageDetail->langsName = 'English';
		}else{
			$this->WebPageDetail->langsName = 'Bengali';
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
	public function admin_index($web_page_id) {
		$this->WebPageDetail->recursive = 0;
		if ($this->request->is('post')) {
			$searchText = addslashes($this->request->data['WebPageDetail']['keywords']);
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"WebPageDetail.question	 LIKE '%".$searchText."%'",
						"WebPageDetail.answer LIKE '%".$searchText."%'",
					)
				)
			);
		}else{
			$this->paginate = array(
				'conditions'=>array(
					'web_page_id'=>$web_page_id
				)
			);
		}
		$this->set('webPageDetails', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->WebPageDetail->exists($id)) {
			throw new NotFoundException(__('Invalid web page detail'));
		}
		$options = array('conditions' => array('WebPageDetail.' . $this->WebPageDetail->primaryKey => $id));
		$this->set('webPageDetail', $this->WebPageDetail->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($web_page_id) {
		if ($this->request->is('post')) {
			$this->WebPageDetail->create();
			$data = $this->request->data;
			$data['WebPageDetail']['web_page_id'] = $web_page_id;
			$datasource = $this->WebPageDetail->getDataSource();
			try {
				$datasource->begin();
				if(!$this->WebPageDetail->save($data)){
					throw new Exception();
				}
				$WebPageDetailId = $this->WebPageDetail->id;
				$data['WebPageDetail']['id'] = $WebPageDetailId;
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->WebPageDetail->tablePrefix = 'english_';
				}else{
					$this->WebPageDetail->tablePrefix = '';
				}
					
				if(!$this->WebPageDetail->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('This content has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action'=>'index',$web_page_id));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The content could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
	public function admin_edit($id = null,$web_page_id) {
		if (!$this->WebPageDetail->exists($id)) {
			throw new NotFoundException(__('Invalid web page detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			
			$updateableDataForOpposite['WebPageDetail']['status'] = $data['WebPageDetail']['status'];
			
			if ($this->WebPageDetail->save($this->request->data)) {
				if($this->langsName =='Bengali'){
					$this->WebPageDetail->tablePrefix = 'english_';
				}else{
					$this->WebPageDetail->tablePrefix = '';
				}
				$this->WebPageDetail->updateData('WebPageDetail', $updateableDataForOpposite, $id, $this->WebPageDetail->tablePrefix);
				$this->Session->setFlash('The web page detail has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index',$web_page_id));
			} else {
				$this->Session->setFlash('The web page detail could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('WebPageDetail.' . $this->WebPageDetail->primaryKey => $id));
			$this->request->data = $this->WebPageDetail->find('first', $options);
		}
		$webPages = $this->WebPageDetail->WebPage->find('list');
		$this->set(compact('webPages'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->WebPageDetail->id = $id;
		if (!$this->WebPageDetail->exists()) {
			throw new NotFoundException(__('Invalid web page detail'));
		}
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->WebPageDetail->getDataSource();
		try {
			$datasource->begin();
			if(!$this->WebPageDetail->delete()){
				throw new Exception();
			}
			 
			if($this->langsName=='Bengali'){
				$this->WebPageDetail->tablePrefix = 'english_';
			}else{
				$this->WebPageDetail->tablePrefix = '';
			}
			$this->WebPageDetail->id = $id;
			if(!$this->WebPageDetail->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The WebPageDetail has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The WebPageDetail could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
	 
		return $this->redirect($this->referer());
	}
}
