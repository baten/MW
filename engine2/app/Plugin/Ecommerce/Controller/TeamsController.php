<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Teams Controller
 *
 * @property Team $Team
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TeamsController extends EcommerceAppController {

	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Team->tablePrefix = 'english_';
			$this->Team->langsName = 'English';
		}else{
			$this->Team->langsName = 'Bengali';
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
		$this->Team->recursive = 0;
		$this->set('teams', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$this->set('team', $this->Team->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Team->create();
			$data = $this->request->data;
			$datasource = $this->Team->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Team->save($data)){
					throw new Exception();
				}
				$TeamId = $this->Team->id;
				$data['Team']['id'] = $TeamId;
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Team->tablePrefix = 'english_';
				}else{
					$this->Team->tablePrefix = '';
				}
					
				if(!$this->Team->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('This team has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action'=>'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The team could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
				
			$updateableDataForOpposite['Team']['status'] = $data['Team']['status'];
			
			if ($this->Team->save($data)) {
				if($this->langsName =='Bengali'){
					$this->Team->tablePrefix = 'english_';
				}else{
					$this->Team->tablePrefix = '';
				}
				$this->Team->updateData('Team', $updateableDataForOpposite, $id, $this->Team->tablePrefix);
				$this->Session->setFlash('The team has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The team could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
			$this->request->data = $this->Team->find('first', $options);
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
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->Team->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Team->delete()){
				throw new Exception();
			}
		
			if($this->langsName=='Bengali'){
				$this->Team->tablePrefix = 'english_';
			}else{
				$this->Team->tablePrefix = '';
			}
			$this->Team->id = $id;
			if(!$this->Team->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The Team has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The Team could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		 
		return $this->redirect(array('action' => 'index'));
	}
}
