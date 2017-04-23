<?php
App::uses('AppController', 'Controller');
/**
 * Media Controller
 *
 * @property Media $Media
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MediaController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Uploader');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Media->recursive = 0;
		$this->set('media', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Media->exists($id)) {
			throw new NotFoundException(__('Invalid media'));
		}
		$options = array('conditions' => array('Media.' . $this->Media->primaryKey => $id));
		$this->set('media', $this->Media->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Media->create();
			if ($this->Media->save($this->request->data)) {
				$this->Session->setFlash('The media has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The media could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Media->exists($id)) {
			throw new NotFoundException(__('Invalid media'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Media->save($this->request->data)) {
				$this->Session->setFlash('The media has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The media could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Media.' . $this->Media->primaryKey => $id));
			$this->request->data = $this->Media->find('first', $options);
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
		$this->Media->id = $id;
		if (!$this->Media->exists()) {
			throw new NotFoundException(__('Invalid media'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Media->delete()) {
			$this->Session->setFlash('The media has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The media could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	/* ajax uploader*/
	public function admin_ajax_uploader(){
		$this->layout = false;
		$this->autoRender = false;
		$ext = $this->Uploader->getFileExtension($_FILES["image"]);
		
		
		$data['Media']['extension'] = $ext;
		
		
		$this->Media->create();
		if ($this->Media->save($data)) {
			$image_id = $this->Media->getInsertId();
				$upload_status = $this->Uploader->upload($_FILES["image"], $image_id, $ext, 'uploads',$fileOrImage = null, $height = '600', $width = '', $oldfile = null );
				if($upload_status == true){
					$return_value['link'] = $this->webroot."img/site/uploads/{$image_id}.$ext";
					return json_encode($return_value);
				}else{
					
				}
				//$this->Session->setFlash('The media has been saved.','default',array('class'=>'alert alert-success'));
			//return $this->redirect(array('action' => 'index'));
		} else {
			//$this->Session->setFlash('The media could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
	}
	//admin_ajax_image_manager admin_ajax_image_delete admin_ajax_uploader
	
	//image loader
	public function admin_ajax_image_manager(){
		$this->layout = false;
		$this->autoRender = false;
		$images = $this->Media->find('list',array('fields'=>array('id','extension')));
		$image_list = array();
		foreach($images as $id => $ext ){
			array_push($image_list, $this->webroot."img/site/uploads/{$id}.$ext");
		}
		return json_encode($image_list);
	}
	
	public function admin_ajax_image_delete(){
		$this->layout = false;
		$this->autoRender = false;
		$data = $this->request->data;
		$img_url = explode('/', $data['src']);
		$url_length = sizeof($img_url);
		$img_name = explode('.',$img_url[$url_length-1]);
		//echo $img_name[0];
		
		
		$this->Media->id = $img_name[0];
		
		$this->request->allowMethod('post', 'delete');
		if ($this->Media->delete()) {
			$this->Uploader->deleteFile($this->webroot."img/site/uploads/{$img_url[$url_length-1]}");
		} 
		
		
	}
}
