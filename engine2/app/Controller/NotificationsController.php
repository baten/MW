<?php
App::uses('AppController', 'Controller');
/**
 * Notifications Controller
 *
 */
class NotificationsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
public $uses = array('Timeout.ClientsOrderStatus','Timeout.Client');


    public function admin_index()
    {
        $this->layout=false;
        //$this->autoRender=false;


        $unviewdorders=$this->ProductOrder->find('count',array('conditions' => array('ProductOrder.view_status' => '0')));
        $newcustomer=$this->Client->find('count',array('conditions' => array('Client.view_status' =>0)));


        $notification["unviewdorders"]=$unviewdorders;
        $notification["newcustomer"]=$newcustomer;

        $this->set('notifications',$notification);


    }
    public function admin_view ()
    {

    }



}
