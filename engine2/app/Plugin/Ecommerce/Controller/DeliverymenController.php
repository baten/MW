<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Deliverymen Controller
 *
 * @property Deliveryman $Deliveryman
 * @property PaginatorComponent $Paginator
 * @property noComponent $no
 */
class DeliverymenController extends EcommerceAppController {

/**
 * Helpers
 *
 * @var array
 */


    public $components = array('Paginator','Session');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {

		$this->Deliveryman->recursive = 0;
		$this->set('deliverymen', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
        $this->Deliveryman->Behaviors->load('Containable');


        if (!$this->Deliveryman->exists($id)) {
			throw new NotFoundException(__('Invalid deliveryman'));
		}
        if ($this->request->is('post')) {


            if (!empty($this->request->data["Deliveryman"]["DeliveryDate"])) {
                $deliverydate= $this->request->data["Deliveryman"]["DeliveryDate"];

                $this->set('deliverydate',$deliverydate);

                $options = array('conditions' => array(
                    'Deliveryman.' . $this->Deliveryman->primaryKey => $id,
                ),
                    'contain' =>array(
                        'ProductOrders'=>array(
                            'conditions' => array(
                                'ProductOrders.delivery_date'=> $deliverydate
                            )

                        )
                    )
                    );



            }
            else {


                $options = array('conditions' => array(
                    'Deliveryman.' . $this->Deliveryman->primaryKey => $id,
                ),
                    'contain' =>array(
                        'ProductOrders'=>array(
                            'conditions' => array(
                                'ProductOrders.delivery_date'=> date("Y-m-d")
                            )

                        )
                    )
                );




            }

        }
        else {


            $options = array('conditions' => array(
                'Deliveryman.' . $this->Deliveryman->primaryKey => $id,
            ),
                'contain' =>array(
                    'ProductOrders'=>array(
                        'conditions' => array(
                            'ProductOrders.delivery_date'=> date("Y-m-d")
                        )

                    )
                )
            );





        }

        $deliveryman= $this->Deliveryman->find('first', $options);
        //pr($deliveryman);

        $this->set('deliveryman',$deliveryman);

	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Deliveryman->create();
			if ($this->Deliveryman->save($this->request->data)) {
				return $this->Session->setFlash('The deliveryman has been saved.', array('action' => 'admin_index'),array('class'=>'alert alert-success'));

            }

		}

    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Deliveryman->exists($id)) {
			throw new NotFoundException(__('Invalid deliveryman'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Deliveryman->save($this->request->data)) {
				return $this->flash('The deliveryman has been saved.', array('action' => 'admin_index'),array('class'=>'alert alert-success'));

            }
		} else {
			$options = array('conditions' => array('Deliveryman.' . $this->Deliveryman->primaryKey => $id));
			$this->request->data = $this->Deliveryman->find('first', $options);
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
		$this->Deliveryman->id = $id;
		if (!$this->Deliveryman->exists()) {
			throw new NotFoundException(__('Invalid deliveryman'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Deliveryman->delete()) {
			return $this->flash('The deliveryman has been deleted.', array('action' => 'admin_index'),array('class'=>'alert alert-success'));
		} else {
			return $this->flash('The deliveryman could not be deleted. Please, try again.', array('action' => 'index'),array('class'=>'alert alert-warnging'));
		}

    }
}
