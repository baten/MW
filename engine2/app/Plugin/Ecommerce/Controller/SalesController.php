<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SalesController extends EcommerceAppController {

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
		$this->Sale->recursive = -1;
		$params = $this->request->params['pass'];
		if ($this->request->is('post')) {
			$data = $this->request->data;
			 
			$cond = 'quantity > 0';
			if(isset($data['Sale']['dateFrom']) & !empty($data['Sale']['dateFrom'])){
				$cond .= " AND created >= '".$data['Sale']['dateFrom']."'";
			}
			if(isset($data['Sale']['dateTo']) & !empty($data['Sale']['dateTo'])){
				$cond .= " AND created <= '".$data['Sale']['dateTo']."'";
			}else{
				if(!empty($data['Sale']['dateFrom'])){
					$cond .= " AND created <= '".$data['Sale']['dateFrom']."'";
				}
			}
			$this->paginate = array(
				'fields'=>array('created','quantity'),
				'conditions'=>array('product_id'=>$params[1],$cond),
				'order'=>array('created' => 'DESC') 
			);
		}else{
			$this->paginate = array(
				'fields'=>array('created','quantity'),
				'conditions'=>array('product_id'=>$params[1]),
				'order'=>array('created'=>'DESC') 
			);
		
		}
		
		$this->set('sales', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
		$this->set('sale', $this->Sale->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Sale->create();
			if ($this->Sale->save($this->request->data)) {
				$this->Session->setFlash('The sale has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The sale could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$products = $this->Sale->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sale->save($this->request->data)) {
				$this->Session->setFlash('The sale has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The sale could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
			$this->request->data = $this->Sale->find('first', $options);
		}
		$products = $this->Sale->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Sale->delete()) {
			$this->Session->setFlash('The sale has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The sale could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
