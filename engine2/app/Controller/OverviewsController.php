<?php
App::uses('AppController', 'Controller');
/**
 * Overviews Controller
 *
 * @property Overview $Overview
 * @property PaginatorComponent $Paginator
 */
class OverviewsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public $cssClass = array('cubes'=>'cubes','map-marker'=>'map-marker','home'=>'home','calendar'=>'calendar');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('cssClasses',$this->cssClass);
		if($this->langsName == 'English'){
			$this->Overview->tablePrefix = 'english_';
			$this->Overview->langsName = 'English';
		}else{
			$this->Overview->langsName = 'Bengali';
		}
	
	}
	

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Overview->recursive = 0;
		if ($this->request->is('post')) {
			$searchText = addslashes($this->request->data['Brand']['keywords']);
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Brand.title LIKE '%".$searchText."%'",
						"Brand.description LIKE '%".$searchText."%'",
					)
				)
			);
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
		$this->set('overviews', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Overview->exists($id)) {
			throw new NotFoundException(__('Invalid overview'));
		}
		$options = array('conditions' => array('Overview.' . $this->Overview->primaryKey => $id));
		$this->set('overview', $this->Overview->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
	if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->Overview->create();
			$datasource = $this->Overview->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Overview->save($data)){
					throw new Exception();
				}
				 
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Overview->tablePrefix = 'english_';
				}else{
					$this->Overview->tablePrefix = '';
				}
			
				if(!$this->Overview->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('The overview has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The overview could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Overview->exists($id)) {
			throw new NotFoundException(__('Invalid overview'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if(!empty($data['Overview']['cssClass'])){
				$updateableDataForOpposite['Overview']['cssClass'] = $data['Overview']['cssClass'];
			} 
			if ($this->Overview->save($data)) {
				if($this->langsName =='Bengali'){
					$this->Overview->tablePrefix = 'english_';
				}else{
					$this->Overview->tablePrefix = '';
				}
				$this->Overview->updateData('Overview', $updateableDataForOpposite, $id, $this->Overview->tablePrefix);
				$this->Session->setFlash('The overview has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The overview could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Overview.' . $this->Overview->primaryKey => $id));
			$this->request->data = $this->Overview->find('first', $options);
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
		$this->Overview->id = $id;
		if (!$this->Overview->exists()) {
			throw new NotFoundException(__('Invalid overview'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Overview->delete()) {
			$this->Session->setFlash('The overview has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The overview could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
