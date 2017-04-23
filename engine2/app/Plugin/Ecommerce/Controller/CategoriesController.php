<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Uploader');
	
	public $uses = array('Ecommerce.Category','Ecommerce.ProductCategory');
	 
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Category->tablePrefix = 'english_';
			$this->Category->langsName = 'English';
		}else{
			$this->Category->langsName = 'Bengali';
		}
		
	}
	
	public function beforeRender() {
		$this->set('refer',$this->request->referer());
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($parent_id = null) {
		/* $data = $this->Category->find('all',array('recursive'=>-1));
		//pr($data);
		foreach($data as $datum){
			$this->Category->query("UPDATE categories SET slug = '".$datum['Category']['slug']."' WHERE id = '".$datum['Category']['id']."'");
		} 
		 */
		$this->Category->recursive = 0;
		$conditions = "parent_id = ''";
		if(!empty($this->params['pass'])){
			$conditions = "parent_id = '".$this->params['pass'][0]."'";
		}
		if ($this->request->is('post')) {  
			$searchText = addslashes(trim($this->request->data['Category']['keywords']));               
			$this->paginate = array(
				'recursive'=>-1,
		 		'limit'=>100,
				'fields'=>array(
					'Category.id',
					'Category.title',
					'Category.status'  
				),
				'conditions'=>array(
					'OR'=>array(
						"Category.title LIKE '%".$searchText."%'",
						"Category.description LIKE '%".$searchText."%'",
					),
					$conditions
				),
				'order'=>array('Category.order'=>'ASC')
			);
		}else{
			$this->paginate = array(
				'recursive'=>-1,
					'fields'=>array(
						'Category.id',
						'Category.title',
						'Category.status'
						), 
					'order'=>array('Category.order'=>'ASC'),
					'conditions'=>array($conditions)
				);  
			
		
		}		
		

		 
		
		$this->set('categories', $this->paginate()); 
		
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			
			$data = $this->request->data;
			
			if(isset($data['CategoryImage']['image']) && $data['CategoryImage']['image']['error'] == 0){
				$data['CategoryImage']['image_extension'] =  $this->Uploader->getFileExtension($data['CategoryImage']['image']);
				$tmpImge = $data['CategoryImage']['image'];
				
				
			}
			 
			//thumb image
			if(isset($data['CategoryImage']['thumbImage']) && $data['CategoryImage']['thumbImage']['error'] == 0){
				$data['CategoryImage']['thumb_extension'] =  $this->Uploader->getFileExtension($data['CategoryImage']['thumbImage']);
				$tmpthumbImge = $data['CategoryImage']['thumbImage'];
				
				
			}
			unset($data['CategoryImage']['image']);
			unset($data['CategoryImage']['thumbImage']);
			if(empty($data['CategoryImage'])){
				unset($data['CategoryImage']);
			}
			$datasource = $this->Category->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Category->save($data)){
					throw new Exception();
				}
				$image_id = $this->Category->id;
				$data['Category']['id'] = $image_id;
				//image upload.
				if(isset($tmpImge) && $tmpImge['error'] == 0){
					$this->Uploader->upload($tmpImge, $image_id, $data['CategoryImage']['image_extension'], 'product_categories',$fileOrImage = null, $height = null, $width = null, $oldfile = null );
				}
				//thumb image upload
				if(isset($tmpthumbImge) && $tmpthumbImge['error'] == 0){
					$this->Uploader->upload($tmpthumbImge, 's-'.$image_id, $data['CategoryImage']['thumb_extension'], 'product_categories',$fileOrImage = null, $height = null, $width = '', $oldfile = null );
				}
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Category->tablePrefix = 'english_';
				}else{
					$this->Category->tablePrefix = '';
				}
	
				if(!$this->Category->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('The category has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The category could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
	
		}
		$parentCategories = $this->category_tree();
		
		$this->set(compact('parentCategories'));
	}


    public function admin_update_special() {
        $this->autoRender = false;
        if($this->request->is('Post')){
            $postData = $this->request->data;
            $result['result'] = false;
            $result['msg'] = 'Update not Successfully./n Please try Again.';
            $data['Category']['id'] = $postData['id'];
            $data['Category']['is_special'] = $postData['is_special'];
            $canUpdate = true;
            if($data['Category']['is_special']){
                $count = $this->Category->find('count',array('conditions'=>array('Category.is_special')));
                if($count > 8){
                    $canUpdate = false;
                    $result['result'] = false;
                    $result['msg'] = 'Maximum 8 Category can be Special.';
                }
            }
            if($canUpdate) {
                $this->Category->id = $postData['id'];
                if ($this->Category->save($data)) {
                    $result['result'] = true;
                    $result['msg'] = 'Update Successfully.';
                } else {
                    $result['result'] = false;
                    $result['msg'] = 'Update not Successfully./n Please try Again.';
                }
            }
            echo json_encode($result);
            exit;
        }
    }

    public function admin_update_featured() {
        $this->autoRender = false;
        if($this->request->is('Post')){
            $postData = $this->request->data;
            $result['result'] = false;
            $result['msg'] = 'Update not Successfully./n Please try Again.';
            $data['Category']['id'] = $postData['id'];
            $data['Category']['is_featured'] = $postData['is_featured'];
            $canUpdate = true;

            if($canUpdate) {
                $this->Category->id = $postData['id'];
                if ($this->Category->save($data)) {
                    $result['result'] = true;
                    $result['msg'] = 'Update Successfully.';
                } else {
                    $result['result'] = false;
                    $result['msg'] = 'Update not Successfully./n Please try Again.';
                }
            }
            echo json_encode($result);
            exit;
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
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		 
		if ($this->request->is(array('post', 'put'))) {
			$categoryPreviousData = $this->Category->CategoryImage->findById($id);
			$data = $this->request->data;
			//pr($categoryPreviousData);die();
			$updateableDataForOpposite = array();
				
			//process data for opposite table
			if(!empty($data['Category']['is_featured'])){
				$updateableDataForOpposite['Category']['is_featured'] = $data['Category']['is_featured'];
			}else{
				$updateableDataForOpposite['Category']['is_featured'] = 0;
			}
		/* 	if(!empty($data['Category']['is_highlighted'])){
				$updateableDataForOpposite['Category']['is_highlighted'] = $data['Category']['is_highlighted'];
			}else{
				$updateableDataForOpposite['Category']['is_highlighted'] = 0;
			} */
			if(!empty($data['Category']['status'])){
				$updateableDataForOpposite['Category']['status'] = $data['Category']['status'];
			}else{
				$updateableDataForOpposite['Category']['status'] = 'inactive';
			}
			//pr($categoryPreviousData);die();
			if(isset($data['CategoryImage']['image']) && $data['CategoryImage']['image']['error'] == 0){
				$data['CategoryImage']['image_extension'] = $this->Uploader->getFileExtension($data['CategoryImage']['image']);
				if(!empty($categoryPreviousData['CategoryImage']['image_extension'])){
					if($categoryPreviousData['CategoryImage']['image_extension'] != $data['CategoryImage']['image_extension']){
						$img_file = WWW_ROOT."img".DS."site".DS."product_categories".DS.$id.".".$categoryPreviousData['CategoryImage']['image_extension'];
						if(file_exists($img_file)){
							$this->Uploader->deleteFile($img_file);
						}
					}
				}
				$tmpImge = $data['CategoryImage']['image'];
				$this->Uploader->upload($data['CategoryImage']['image'], $id, $data['CategoryImage']['image_extension'], 'product_categories',$fileOrImage = null, $height = null, $width = null, $oldfile = null );
			}
			
			//thumb image upload.
			if(isset($data['CategoryImage']['thumbImage']) && $data['CategoryImage']['thumbImage']['error'] == 0){
				$data['CategoryImage']['thumb_extension'] = $this->Uploader->getFileExtension($data['CategoryImage']['thumbImage']);
				if(!empty($categoryPreviousData['CategoryImage']['thumb_extension'])){
					if($categoryPreviousData['CategoryImage']['thumb_extension'] != $data['CategoryImage']['thumb_extension']){
						$thumb_image = WWW_ROOT."img".DS."site".DS."product_categories".DS."s-".$id.".".$categoryPreviousData['CategoryImage']['thumb_extension'];
						if(file_exists($thumb_image)){
							$this->Uploader->deleteFile($thumb_image);
						}
					}
				}
				
				$this->Uploader->upload($data['CategoryImage']['thumbImage'],'s-'. $id, $data['CategoryImage']['thumb_extension'], 'product_categories',$fileOrImage = null, $height = null, $width = null, $oldfile = null );
			}
			unset($data['CategoryImage']['image']);
			unset($data['CategoryImage']['thumbImage']);
			//pr($data);die();
			//pr($data);die();
			
			if ($this->Category->saveAssociated($data)) {
				$slugData = $this->Category->findById($id,array('Category.slug'));
				if($this->langsName =='Bengali'){
					$this->Category->tablePrefix = 'english_';
				}else{
					$this->Category->tablePrefix = '';
					$updateableDataForOpposite['Category']['slug'] = $slugData['Category']['slug'];
				}
				$this->Category->updateData('Category', $updateableDataForOpposite, $id, $this->Category->tablePrefix);
				
				$this->Session->setFlash('The category has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The category could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$parentCategories = $this->category_tree();
		$this->set(compact('parentCategories'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->allowMethod('post', 'delete');
		$categoryImageData =$this->Category->CategoryImage->getCategoryImageById($id);
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->Category->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Category->delete()){
				throw new Exception();
			}
			if(!empty($categoryImageData['CategoryImage']['image_extension'])){
				$img_file = WWW_ROOT."img".DS."site".DS."product_categories".DS.$categoryImageData['CategoryImage']['id'].".".$categoryImageData['CategoryImage']['image_extension'];
				if(file_exists($img_file)){
					$this->Uploader->deleteFile($img_file);
				}
			}
			// delete category thumb image
			if(!empty($categoryImageData['CategoryImage']['thumb_extension'])){
				$thumb_img = WWW_ROOT."img".DS."site".DS."product_categories".DS.'s-'.$categoryImageData['CategoryImage']['id'].".".$categoryImageData['CategoryImage']['thumb_extension'];
				if(file_exists($thumb_img)){
					$this->Uploader->deleteFile($thumb_img);
				}
			}
			if($this->langsName=='Bengali'){
				$this->Category->tablePrefix = 'english_';
			}else{
				$this->Category->tablePrefix = '';
			}
			$this->Category->id = $id;
			if(!$this->Category->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The category has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The category could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		
		return $this->redirect(array('action' => 'index'));
	}
	
	
	 
	
	public function admin_sort() {
		if ($this->request->is('post')) {
				
			$data = $this->request->data;
			//pr($data);die();
			$i = 1;
			$orderData = array();
			foreach ($data['order'] AS $datum){
				$orderData[$i]['Category']['id'] = $datum;
				$orderData[$i]['Category']['order'] = $i;
				//$this->Category->id = $datum;
				//$this->Category->saveField('order', $i);
				$i++;
		
			}
			//pr($orderData);die();
		
			
			$datasource = $this->Category->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Category->saveMany($orderData)){
					throw new Exception();
				}
				  
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Category->tablePrefix = 'english_';
				}else{
					$this->Category->tablePrefix = '';
				}
			
				if(!$this->Category->saveMany($orderData)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('These category has been sorted.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('These category could not be sorted. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
			
			return $this->redirect('sort');
		}
		
		$categories = $this->Category->find(
			'threaded',
			array(
				'fields' => array('id','title','order','parent_id'),
				'order'  => array('order' => 'ASC'),
				'recursive' => -1,
				//'conditions' => array('Category.parent_id != ' => '')
			)
		);
		
		$this->set(compact('categories'));
	}
	
	private function category_tree(){
		$data = $this->Category->find(
			'threaded',
			array(
				'contain' => array(),
				'conditions'=>array(
					'status'=>'active'
				),
				//'order' => 'order'
			)
		);
		//array_ma
		$listString = $this->TreeList($data);
		$listArray = explode('#id#',$listString);
		$catTreeList = array();
		for($i=1; $i<sizeof($listArray); $i++){
			$listIndData = explode('#title#', $listArray[$i]);
			$catTreeList[$i]['id'] = $listIndData[0];
			$catTreeList[$i]['title'] = $listIndData[1];
		}
			
		$categories = array();
		foreach ($catTreeList as $catList){
			$categories[$catList['id']] = $catList['title'];
		}
	
		return $categories;
	
	}
	
	private function TreeList($threaded,$level=0,&$html = '') {
		if(sizeof($threaded)>0){
			foreach ($threaded as $key => $node) {
				foreach ($node as $type => $threaded) {
					if ($type !== 'children') {
						$dash_html = '';
						for($i = 1; $i<= $level; $i++){
							$dash_html .= ' - ';
						}
						$html .="#id#".$threaded['id']."#title#".$dash_html." ".$threaded['title'];
					} else {
						if (!empty($threaded)) {
							$html .= $this->TreeList($threaded,$level+1);
						}
					}
				}
			}
		}
		return $html;
	}
}
