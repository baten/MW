<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Stocks Controller
 *
 * @property Stock $Stock
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class StocksController extends EcommerceAppController {

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
		$this->Stock->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'fields'=>array('SUM(Stock.quantity) AS total','Product.id','Product.title'),
				'group'=>array('Product.id'),
				'conditions'=>array(
					'OR'=>array(
						"Product.title LIKE '%".$this->request->data['Stock']['keywords']."%'",
					)
				)
			);
		}else{
			$this->paginate = array(
				'fields'=>array('SUM(Stock.quantity) AS total','Product.id','Product.title'),
				'group'=>array('Product.id'),
				'order'=>array('Stock.created'=>'DESC')
			);
		}
		$this->set('stocks', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($title,$id) {
		$this->Stock->recursive = -1;
		
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$cond = 'Stock.quantity > 0';
			if(isset($data['Stock']['dateFrom']) & !empty($data['Stock']['dateFrom'])){
			 	$cond .= " AND Stock.created >= '".$data['Stock']['dateFrom']."'";
			}
		 	if(isset($data['Stock']['dateTo']) & !empty($data['Stock']['dateTo'])){
		 		$cond .= " AND Stock.created <= '".$data['Stock']['dateTo']." 23:59:59'";
		 	}else{
		 		if(!empty($data['Stock']['dateFrom'])){
			 		$cond .= " AND Stock.created <= '".$data['Stock']['dateFrom']." 23:59:59'";
			 	}
		 	}
		 	
		 	$this->paginate = array(
		 		'fields'=>array('id','created','quantity'),
		 		'conditions'=>array('product_id'=>$id,$cond)
		 	);
					
		}else{
			$this->paginate = array(
				'fields'=>array('id','created','quantity'),
				'conditions'=>array('product_id'=>$id)
			);
		}
		
		$this->set('stocks', $this->Paginator->paginate());
	}
	

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Stock->create();
			if ($this->Stock->save($this->request->data)) {
				$this->Session->setFlash('The stock has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The stock could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$products = $this->Stock->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null,$productName,$productId) {
		if (!$this->Stock->exists($id)) {
			throw new NotFoundException(__('Invalid stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Stock->save($this->request->data)) {
				$this->Session->setFlash('The stock has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'view',$productName,$productId));
			} else {
				$this->Session->setFlash('The stock could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
			$this->request->data = $this->Stock->find('first', $options);
		}
		$products = $this->Stock->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null,$productName,$productId) {
		$this->Stock->id = $id;
		if (!$this->Stock->exists()) {
			throw new NotFoundException(__('Invalid stock'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Stock->delete()) {
			$this->Session->setFlash('The stock has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The stock could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'view',$productName,$productId));
	}
}
