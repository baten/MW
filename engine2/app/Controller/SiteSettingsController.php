<?php
App::uses('AppController', 'Controller');
/**
 * SiteSettings Controller
 *
 * @property SiteSetting $SiteSetting
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SiteSettingsController extends AppController {

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
		$site = $this->SiteSetting->find('all'); 
		if(isset($site[0])){
			$this->redirect(array('controller'=>'site_settings','action'=>'edit',$site[0]['SiteSetting']['id'], 'admin'=>true));
		}else{
			$this->redirect(array('controller'=>'site_settings','action'=>'add','admin'=>true));
		}
		
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->SiteSetting->exists($id)) {
			throw new NotFoundException(__('Invalid site setting'));
		}
		$options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => $id));
		$this->set('siteSetting', $this->SiteSetting->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$data['SiteSetting']['google_analytics_data'] = json_encode($data['SiteSetting']['google_analytics_data']);
			
			$this->SiteSetting->create();
			if ($this->SiteSetting->save($data)) {
				$this->Session->setFlash('The site setting has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The site setting could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->SiteSetting->exists($id)) {
			throw new NotFoundException(__('Invalid site setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$data['SiteSetting']['google_analytics_data'] = json_encode($data['SiteSetting']['google_analytics_data']);
			
			if ($this->SiteSetting->save($data)) {
				// logo upload
				if(isset($data['SiteSetting']['logo']) && $data['SiteSetting']['logo']['error'] == 0){
					$this->Uploader->upload($data['SiteSetting']['logo'], $id, 'png', '',$fileOrImage = null, $height = '67', $width = '', $oldfile = null);
				}

				$this->Session->setFlash('The site setting has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The site setting could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => $id));
			$data= $this->SiteSetting->find('first', $options);
			$data['SiteSetting']['google_analytics_data'] = json_decode($data['SiteSetting']['google_analytics_data'],true);
			$this->request->data = $data;
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
		$this->SiteSetting->id = $id;
		if (!$this->SiteSetting->exists()) {
			throw new NotFoundException(__('Invalid site setting'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SiteSetting->delete()) {
			$this->Session->setFlash('The site setting has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The site setting could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
