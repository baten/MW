<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Demages Controller
 *
 * @property Demage $Demage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DemagesController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
    public $uses = array('Ecommerce.Demage','Ecommerce.Product');
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Demage->recursive = 0;
		$this->set('demages', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Demage->exists($id)) {
			throw new NotFoundException(__('Invalid demage'));
		}
		$options = array('conditions' => array('Demage.' . $this->Demage->primaryKey => $id));
		$this->set('demage', $this->Demage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $this->request->data["Demage"]["product_id"]));
          $product=$this->Product->find('first', $options);
			$this->Demage->create();

            $data1["Product"]["demage"]=$product["Product"]["demage"]+$this->request->data["Demage"]["quantity"];
            $this->Demage->updateData('Product', $data1,$this->request->data["Demage"]["product_id"], 'english_');
            $this->Demage->updateData('Product', $data1, $this->request->data["Demage"]["product_id"], '');
            $this->request->data['Demage']['createdby']=$this->Auth->user()["username"];
            $this->request->data['Demage']['updatedby']=$this->Auth->user()["username"];

            if ($this->Demage->save($this->request->data)) {
				$this->Session->setFlash('The demage has been saved.','default',array('class'=>'alert alert-success'));

				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The demage could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$products = $this->Demage->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_recover($id = null) {
		if (!$this->Demage->exists($id)) {
			throw new NotFoundException(__('Invalid demage'));
		}
		if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Demage']['updatedby']=$this->Auth->user()["username"];
			if ($this->Demage->save($this->request->data)) {
                $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $this->request->data["Demage"]["product_id"]));
                $product=$this->Product->find('first', $options);

                $data1["Product"]["demage"]=$product["Product"]["demage"]-$this->request->data["Demage"]["quantity"];
                $this->Demage->updateData('Product', $data1,$this->request->data["Demage"]["product_id"], 'english_');
                $this->Demage->updateData('Product', $data1, $this->request->data["Demage"]["product_id"], '');
				$this->Session->setFlash('The demage has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The demage could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}

            pr($this->request->data);
		} else {
			$options = array('conditions' => array('Demage.' . $this->Demage->primaryKey => $id));
			$this->request->data = $this->Demage->find('first', $options);
		}
		$products = $this->Demage->Product->find('list');
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
		$this->Demage->id = $id;
		if (!$this->Demage->exists()) {
			throw new NotFoundException(__('Invalid demage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Demage->delete()) {
			$this->Session->setFlash('The demage has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The demage could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
