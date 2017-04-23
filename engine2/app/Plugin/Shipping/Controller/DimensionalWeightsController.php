<?php
App::uses('ShippingAppController', 'Shipping.Controller');
/**
 * DimensionalWeights Controller
 *
 * @property DimensionalWeight $DimensionalWeight
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DimensionalWeightsController extends ShippingAppController {

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
		$this->DimensionalWeight->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"dimensionalWeights.packageName LIKE '%".$this->request->data['DimensionalWeight']['keywords']."%'",
						"dimensionalWeights.dimensionWeight LIKE '%".$this->request->data['DimensionalWeight']['keywords']."%'"
					)
				)
			);
		}else{
			$this->paginate = array('order'=>array('dimensionWeight'=>'ASC'));
		}
		$this->set('dimensionalWeights', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DimensionalWeight->exists($id)) {
			throw new NotFoundException(__('Invalid dimensional weight'));
		}
		$options = array('conditions' => array('DimensionalWeight.' . $this->DimensionalWeight->primaryKey => $id));
		$this->set('dimensionalWeight', $this->DimensionalWeight->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->DimensionalWeight->create();
			if ($this->DimensionalWeight->save($this->request->data)) {
				$this->Session->setFlash('The dimensional weight has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The dimensional weight could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->DimensionalWeight->exists($id)) {
			throw new NotFoundException(__('Invalid dimensional weight'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DimensionalWeight->save($this->request->data)) {
				$this->Session->setFlash('The dimensional weight has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The dimensional weight could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('DimensionalWeight.' . $this->DimensionalWeight->primaryKey => $id));
			$this->request->data = $this->DimensionalWeight->find('first', $options);
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
		$this->DimensionalWeight->id = $id;
		if (!$this->DimensionalWeight->exists()) {
			throw new NotFoundException(__('Invalid dimensional weight'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DimensionalWeight->delete()) {
			$this->Session->setFlash('The dimensional weight has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The dimensional weight could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
