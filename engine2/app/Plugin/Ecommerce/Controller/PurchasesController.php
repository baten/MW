<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Purchases Controller
 *
 * @property Purchase $Purchase
 * @property PaginatorComponent $Paginator
 * @property nComponent $n
 * @property SessionComponent $Session
 */
class PurchasesController extends EcommerceAppController {

/**
 * Helpers
 *
 * @var array
 */
    public $uses = array('Ecommerce.Purchase','Ecommerce.Product');


    public function beforeFilter(){
        parent::beforeFilter();

        if($this->langsName == 'English'){
            $this->Product->tablePrefix = 'english_';
        }


    }
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {

        if ($this->request->is('post')) {
            $searchText = addslashes($this->request->data['Purchase']['keywords']);
            $this->paginate = array(
                'conditions'=>array(
                        "Product.title LIKE '%".$searchText."%'",
                )

            );
        }else{
            $this->Purchase->recursive = 0;
        }

        $this->set('purchases', $this->Paginator->paginate());

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Purchase->exists($id)) {
			throw new NotFoundException(__('Invalid purchase'));
		}
		$options = array('conditions' => array('Purchase.' . $this->Purchase->primaryKey => $id));
		$this->set('purchase', $this->Purchase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
            $this->request->data['Purchase']['created']=date("Y-m-d H:i:s");
			$this->Purchase->create();
			if ($this->Purchase->save($this->request->data)) {
				$this->Session->setFlash('The purchase has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The purchase could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$products = $this->Purchase->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Purchase->exists($id)) {
			throw new NotFoundException(__('Invalid purchase'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Purchase->save($this->request->data)) {
				$this->Session->setFlash('The purchase has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The purchase could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Purchase.' . $this->Purchase->primaryKey => $id));
			$this->request->data = $this->Purchase->find('first', $options);
		}
		$products = $this->Purchase->Product->find('list');
		$this->set(compact('products'));
	}

    public function admin_add_to_stock($id = null) {
        if (!$this->Purchase->exists($id)) {
            throw new NotFoundException(__('Invalid purchase'));
        }

        $options = array('conditions' => array('Purchase.' . $this->Purchase->primaryKey => $id));
        $purchase=$this->Purchase->find('first', $options);


        $data1["Product"]['purchased'] = $purchase['Product']['purchased'] + $purchase['Purchase']['quantity'];

        $this->Purchase->updateData('Product', $data1, $purchase['Product']['id'], 'english_');
        $this->Purchase->updateData('Product', $data1, $purchase['Product']['id'], '');



            $data["Purchase"]['stock']=1;
            $data["Purchase"]['id']=$id;

            if ($this->Purchase->save($data)) {
                $this->Session->setFlash('The purchase has been saved.','default',array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }








    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Purchase->id = $id;
		if (!$this->Purchase->exists()) {
			throw new NotFoundException(__('Invalid purchase'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Purchase->delete()) {
			$this->Session->setFlash('The purchase has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The purchase could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
