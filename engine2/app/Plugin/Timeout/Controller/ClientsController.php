<?php
App::uses('TimeoutAppController', 'Timeout.Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ClientsController extends TimeoutAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array(
        'Timeout.Client',
        'Shipping.Country'
    );
/**
 * admin_index method
 *
 * @return void
 */
public function admin_index() {
        $lastCreated = $this->Client->find('first', array(
            'order' => array('Client.created' => 'desc')
        ));




		$this->Client->recursive = 0;

        if ($this->request->is('post')) {
            $searchText = addslashes($this->request->data['Client']['keywords']);
            $this->paginate = array(
                'conditions' => array(
                    'OR' => array(
                        "Client.username LIKE '%" . $searchText . "%'",
                        "Client.details LIKE '%" . $searchText . "%'",
                        "Client.id = '" . $searchText . "'"

                    )
                )
            );
        }


        $unviewcustomers=$this->Client->find('all',array('conditions' => array('Client.view_status' => 0 )));

    $this->set('clients', $this->Paginator->paginate());


        foreach ($unviewcustomers as $customer )
        {
            $this->Client->save(array('id' => $customer['Client']['id'], 'view_status' => 1 ));

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
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Invalid client'));
        }
        $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
        $client=$this->Client->find('first', $options);

        $this->set('client',$client);

        $abc=$this->Paginator->paginate(
            'ProductOrder',
            array('ProductOrder.client_detail LIKE' =>  '%'.$id.'%')
        );
        $this->set('productOrders',$abc);




    }

/**
 * admin_add method
 *
 * @return void
 */
    public function admin_add() {
        $countrylist=$this->Country->find('list');
        $this->set("countrylist",$countrylist);


        if ($this->request->is('post')) {


            if( $this->request->data['Client']['password']== $this->request->data['confirm']['password'])
            {
                $this->request->data['Client']['details']=json_encode($this->request->data['details']);
                $this->request->data['Client']['createdby']=$this->Auth->user()["username"];
                $this->request->data['Client']['updatedby']=$this->Auth->user()["username"];


                $this->Client->create();
                if ($this->Client->save($this->request->data)) {
                    $this->Session->setFlash('The client has been saved.','default',array('class'=>'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));

                }
                else {

                    $this->Session->setFlash('Some error is found','default',array('class'=>'alert alert-warnging'));



                }

            }
            else {

                $this->Session->setFlash('Password not matched with retype password','default',array('class'=>'alert alert-warnging'));



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

        $countrylist=$this->Country->find('list',array('fields'=>array('country_name','country_name')));
        $this->set("countrylist",$countrylist);
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Invalid client'));
        }
        if ($this->request->is(array('post', 'put'))) {




            $this->request->data['Client']['details']=json_encode($this->request->data['details']);

            $this->Client->create();
            if ($this->Client->save($this->request->data)) {
                $this->Session->setFlash('The client has been saved.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));

            }
            else {

                $this->Session->setFlash('Something with wrong with your input','default',array('class'=>'alert alert-warnging'));



            }



        } else {
            $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
            $this->request->data = $this->Client->find('first', $options);

            $this->set('details',json_decode($this->request->data['Client']['details'],true));


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
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Client->delete()) {
			$this->Session->setFlash('The client has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The client could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
