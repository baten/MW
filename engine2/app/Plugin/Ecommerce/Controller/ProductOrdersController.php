<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');

/**
 * ProductOrders Controller
 *
 * @property ProductOrder $ProductOrder
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductOrdersController extends EcommerceAppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'EmailSender', 'Uploader');

    public $uses = array(
        'Ecommerce.ProductOrder',
        'Ecommerce.Product',
        'Ecommerce.ProductKeie',
        'Ecommerce.Attribute',
    	'Ecommerce.ProductStock',
        'SiteSetting',
        'Ecommerce.Deliveryman',
        'Ecommerce.ProductOrderNote',
        'Timeout.Client'
    );

    /**
     * admin_index method
     *
     * @return void
     */
    protected $order_status = array(
        'ordered' => 'Ordered',
        'processing' => 'Processing',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->set('order_status', $this->order_status);
        $this->Auth->allow('order_view', 'send_email');
    }
 
    public function admin_index()
    {
        $this->ProductOrder->recursive = 0;
        $this->ProductOrder->order = array('ProductOrder.order_date' => 'DESC');

        if ($this->request->is('post')) {
        	$searchText = addslashes($this->request->data['ProductOrder']['keywords']);
            $this->paginate = array(
                'conditions' => array(
                    'OR' => array(
                        "ProductOrder.status LIKE '%" . $searchText . "%'",
                    	"ProductOrder.client_detail LIKE '%" . $searchText . "%'"
                    )
                )
            );
        }
        $this->set('productOrders', $this->Paginator->paginate());
        //$this->set('merchants',$this->getMerchants());
    }


    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
        $this->set('productOrder', $this->ProductOrder->find('first', $options));
    }
  
    public function admin_order_view($id = null, $page = 'view',$isNotViewed = null)
    {
        $deliverymen = $this->Deliveryman->find('list');

        $this->set('deliverymen', $deliverymen);

        if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
        $order_data = $this->ProductOrder->find('first', $options);
        
        if(!empty($isNotViewed)){
        	$this->ProductOrder->id = $id;
        	$this->ProductOrder->saveField('view_status', '1');
        }

        $data['client_detail'] = json_decode($order_data['ProductOrder']['client_detail'], true);
        $data['order_detail'] = json_decode($order_data['ProductOrder']['order_detail'], true);
        $data['payment_detail'] = ($order_data['ProductOrder']['payment_detail']);
        $data['shipping_detail'] = ($order_data['ProductOrder']['shipping_detail']);
        $data['status'] = ($order_data['ProductOrder']['status']);
        $data['payment_status'] = ($order_data['ProductOrder']['payment_status']);
        $data['complete_date'] = ($order_data['ProductOrder']['complete_date']);
        $data['order_date'] = ($order_data['ProductOrder']['order_date']);
        $data['order_code'] = ($order_data['ProductOrder']['order_code']);
        $data['id'] = $id;
        $data['deliveryman'] = ($order_data['Deliveryman']);
        $data['note'] = ($order_data['ProductOrder']['note']);
        $data['delivery_date'] = ($order_data['ProductOrder']['delivery_date']);



        $this->set('data', $data);
        $this->set('page', $page);


        if ($page != 'view') {
            /* Make sure the controller doesn't auto render. */
            $this->autoRender = false;
            $this->layout = false;
            $pdfdata = array();
            $pdfdata['generate_type'] = $page;
            $pdfdata['html'] = $this->render($this->params['action']);
            $pdfdata['title'] = 'Order Invoice';
            $pdfdata['print_content_with_logo'] = true;

            $this->Session->write('pdfdata', $pdfdata);
            if ($this->request->is('ajax')) {
                echo true;
                exit;
            }
            $this->redirect(array('plugin' => false, 'controller' => 'supporter', 'action' => 'generate'));
        }
    }
    
    public function admin_unview()
    {
    	$this->ProductOrder->recursive = 0;
    	$this->ProductOrder->order = array('ProductOrder.order_date' => 'DESC');
    
    	if ($this->request->is('post')) {
    		$searchText = addslashes($this->request->data['ProductOrder']['keywords']);
    		$this->paginate = array(
    			'conditions' => array(
    				'AND'=> array (
    					"ProductOrder.view_status = '0'",
    					'OR' => array(
    						"ProductOrder.id = '" . $searchText . "'",
    						"ProductOrder.status LIKE '%" . $searchText . "%'",
    						"ProductOrder.client_detail LIKE '%" . $searchText . "%'"
    
    					)
    				)
    
    			)
    		);
    	}
    	else {
    		$this->paginate = array(
    			'conditions' => array("ProductOrder.view_status = '0'")
    		);
    	}
    
    
    	$this->set('productOrders', $this->Paginator->paginate());
    	$this->render("admin_index");
    	//$this->set('merchants',$this->getMerchants());
    }

    public function order_view($id = null, $page = 'view',$save=NULL)
    {

     if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
        $order_data = $this->ProductOrder->find('first', $options);


        $data['client_detail'] = json_decode($order_data['ProductOrder']['client_detail'], true);
        $data['order_detail'] = json_decode($order_data['ProductOrder']['order_detail'], true);
        $data['payment_detail'] = ($order_data['ProductOrder']['payment_detail']);
        $data['shipping_detail'] = ($order_data['ProductOrder']['shipping_detail']);
        $data['status'] = ($order_data['ProductOrder']['status']);
        $data['payment_status'] = ($order_data['ProductOrder']['payment_status']);
        $data['complete_date'] = ($order_data['ProductOrder']['complete_date']);
        $data['order_date'] = ($order_data['ProductOrder']['order_date']);
        $data['order_code'] = ($order_data['ProductOrder']['order_code']);
        $data['id'] = $id;

        $this->set('data', $data);
        $this->set('page', $page);


        if ($page != 'view') {
            /* Make sure the controller doesn't auto render. */
            $this->autoRender = false;
            $this->layout = false;
            $pdfdata = array();
            $pdfdata['generate_type'] = $page;
            $pdfdata['html'] = $this->render($this->params['action']);
            $pdfdata['title'] = 'Order Invoice';
            $pdfdata['print_content_with_logo'] = true;

            $this->Session->write('pdfdata', $pdfdata);
            if ($this->request->is('ajax')) {
                echo true;
                exit;
            }
            $this->redirect(array('plugin' => false, 'controller' => 'supporter', 'action' => 'generate'));
        }
    }

    /**
     * admin_add method
     *
     * @return void
     */

    private function order_product($id=null)
    {

      
        if($id)
        {
            $data['ProductOrder']['id']=$id;
            $msg="succesfully updated";
            $data['ProductOrder']['updatedby']=$this->Auth->user()["username"];
        }
        else {
            $data['ProductOrder']['createby']=$this->Auth->user()["username"];
            $data['ProductOrder']['updatedby']=$this->Auth->user()["username"];
            $msg="succesfully Created";
        }




        $discount=$this->Session->read('order.discount');
        $cart=$this->Session->read('order.cart');
        $address= $this->Session->read('order.address_line_1');
        $address2= $this->Session->read('order.address_line_2');
        $region= $this->Session->read('order.region');
        $poBox= $this->Session->read('order.poBox');
        $state= $this->Session->read('order.state');
        $country= $this->Session->read('order.country');

        $phone=$this->Session->read('order.phone');
        $client= $this->Session->read('order.client');
        $delivery= $this->Session->read('order.delivery');

        $siteseting=$this->SiteSetting->find("first");

        $shipping_detail['fname']=$client['Client']['details']['fname'];
        $shipping_detail['lname']=$client['Client']['details']['lname'];

        $shipping_detail['phone']=$phone;
        $shipping_detail["address_line_1"]=$address;
        $shipping_detail["address_line_2"]=$address2;
        $shipping_detail['country']=$country;
        $shipping_detail['region']=$region;
        $shipping_detail['poBox']=$poBox;
        $shipping_detail['state']=$state;


        $shipping_detail['paymentMethod']=$delivery['payment'];
        $shipping_detail['shippingCost']=$siteseting['SiteSetting']['shippingCharge'];


        $data['ProductOrder']['shipping_detail']=json_encode($shipping_detail);


        if(empty($cart) ||empty($address)||empty($phone)  )
        {
            if($id)
            {
                $this->Session->setFlash(' cart  Or phone or Address is empty', 'default', array('class' => 'alert alert-error'));
                return $this->redirect(array('action' => 'admin_edit',$data['ProductOrder']['id'],"plugin"=>"ecommerce","admin"=>true));

            }
            else {
                $this->Session->setFlash('cart  Or phone or Address is empty', 'default', array('class' => 'alert alert-error'));
                return $this->redirect(array('action' => 'admin_add',$client["Client"]["id"],"plugin"=>"ecommerce","admin"=>true));
            }


        }
        $index=0;
        foreach ($cart as $item)
        {
            $order_detail["cart"][$index]["attributes"]=$item['attribute'];
            if(!empty($item['product']['ProductImage'])){
                if(file_exists("img/site/products/{$item['product']['ProductImage'][0]['id']}.{$item['product']['ProductImage'][0]['extension']}"))
                {
                    $order_detail["cart"][$index]["imgUrl"]= "site/products/".$item['product']['ProductImage'][0]['id'].".".$item['product']['ProductImage'][0]['extension'];
                }
            }
            $order_detail["cart"][$index]["productQuantity"]=$item['unit'];
            $order_detail["cart"][$index]["productId"]=$item['product']['Product']['id'];
            $order_detail["cart"][$index]["productTitle"]=$item['product']['Product']['title'];
            $order_detail["cart"][$index]["productSlug"]=$item['product']['Product']["slug"];
            $order_detail["cart"][$index]["productBasePrice"]=$item['product']['Product']['sale_price']?$item['product']['Product']['sale_price']:$item['product']['Product']['price'] ;





        $index++;
        }





        $order_detail["discount"]=$discount? $discount:0;
        $data['ProductOrder']['view_status']=1;




        $data['ProductOrder']['order_detail']=json_encode($order_detail);

        unset($client['Client']['password']);
        $client['Client']["details"]=json_encode($client['Client']["details"]);

        $data['ProductOrder']['client_detail']=json_encode($client['Client']);

        $data['ProductOrder']['status']="ordered";



        $this->ProductOrder->create();

        if ($productorder=$this->ProductOrder->save($data)) {
            $this->Session->setFlash($msg,'default',array('class'=>'alert alert-success'));
            $this->Session->delete('order');
            return $this->redirect(array('action' => 'order_view',$productorder["ProductOrder"]['id'],"view"));


        }



    }

    public function admin_add($clientid=null)
    {



        if(!$clientid) {
            $this->set('clients',  $this->Paginator->paginate('Client'));
            $this->render('admin_add_clients');



        }
        else {




            $paymentlist=array ("Cash on Delivery"=>"Cash on Delivery","bikash"=>"bikash",);
            $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $clientid));
            $client=$this->Client->find("first",$options);

            $client['Client']['details']=json_decode($client['Client']['details'],true);
            if( $this->Session->check('order'))
            {
                if($this->Session->read('order.client.Client.id')!=$client['Client']['id'])
                {
                    $this->Session->delete('order');

                }
            }
            if( !$this->Session->check('order.client'))
            {
                $this->Session->write('order.client', $client);
                $this->Session->write('order.address_line_1', $client['Client']['details']['address_line_1']);
                $this->Session->write('order.phone', $client['Client']['details']['phone']);
                $this->Session->write('order.address_line_2', $client['Client']['details']['address_line_2']);
                $this->Session->write('order.region', $client['Client']['details']['region']);
                $this->Session->write('order.poBox', $client['Client']['details']['poBox']);
                $this->Session->write('order.state', $client['Client']['details']['state']);
                $this->Session->write('order.country', $client['Client']['details']['country']);
                $this->Session->write('order.payment', "Cash on Delivery");
                $delivery['payment'] ="Cash on Delivery";
                $delivery['instruction'] =" ";
                $this->Session->write('order.delivery', $delivery);

            }

            if ($this->request->is('post')) {
                $productid = !empty($this->request->data['ProductOrder']['Product']) ? $this->request->data['ProductOrder']['Product'] : '';

                if ($this->request->data["action"] == "getproduct")
                {
                    $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $productid));
                    $product = $this->Product->find("first", $options);

                    if(sizeof($product["ProductAttribute"]))
                    {
                        $attriobutes=array();
                        for ($i=0;$i<sizeof($product["ProductAttribute"]);$i++)
                        {
                            $productAttribute = $this->Attribute->find(
                                'all',
                                array(
                                    'recursive'=>-1,
                                    'fields'=>array('id','title'),
                                    'contain' => array('AttributeValue'=>array('fields'=>array('id','value'))),
                                    'conditions'=>array('Attribute.id' =>  $product["ProductAttribute"][$i]["attribute_id"])
                                )
                            );
                            $attriobutes[]=$productAttribute;

                        }
                        $this->set('attribute',$attriobutes);


                    }
                    else {
                        $this->set('attribute',0);

                    }

                    return $this->render('admin_get_product');

                }

                else if ($this->request->data["action"] == "add") {



                    $unit = $this->request->data['ProductOrder']['unit'];

                    $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $productid));
                    $product = $this->Product->find("first", $options);

                    $attribute=array();


                    $productstring=$productid;

                    if(!empty($this->request->data['ProductOrder']["attribute"]))
                    {
                        foreach ($this->request->data['ProductOrder']["attribute"] as $key=> $value)

                        {
                            $productstring.="_".$key."_".$value;

                        }
                        $attribute=$this->request->data['ProductOrder']["attribute"];


                    }

                    $productcart=array (
                        "product"=> $product,
                        "unit"=>$unit,
                        "attribute"=>$attribute

                    );


                    $this->Session->write('order.cart.'.$productstring, $productcart);

                }


                elseif ($this->request->data["action"] == "remove") {
                    $this->Session->delete('order.cart.' . $productid);

                }
                elseif ($this->request->data["action"] == "reset") {
                    $this->Session->write('order.discount', 0);
                    $this->Session->write('order.phone', $client['Client']['details']['phone']);
                    $this->Session->delete('order.cart');

                }
                elseif ($this->request->data["action"] == "updateunit") {
                    $unit = $this->request->data['ProductOrder']['unit'];

                    $this->Session->write('order.cart.' . $productid . ".unit", $unit);

                }
                elseif ($this->request->data["action"] == "discount") {
                    $discount = $this->request->data['ProductOrder']['discount'];
                    $this->Session->write('order.discount', $discount);



                }
                elseif($this->request->data["action"] == "order")
                {
                    $address = $this->request->data['ProductOrder']['address_line_1'];
                    $address2 = $this->request->data['ProductOrder']['address_line_2'];
                    $phone = $this->request->data['ProductOrder']['phone'];
                    $state = $this->request->data['ProductOrder']['state'];
                    $region = $this->request->data['ProductOrder']['region'];
                    $poBox = $this->request->data['ProductOrder']['poBox'];
                    $country = $this->request->data['ProductOrder']['country'];


                    $delivery['payment'] = $this->request->data['ProductOrder']['payment'];
                    $this->Session->write('order.address_line_1', $address);
                    $this->Session->write('order.phone', $phone);
                    $this->Session->write('order.state', $state);
                    $this->Session->write('order.region', $region);
                    $this->Session->write('order.poBox', $poBox);
                    $this->Session->write('order.address_line_2', $address2);
                    $this->Session->write('order.country', $country);


                    $this->order_product();

                }

                
            }

            $this->set('discount', $this->Session->read('order.discount')?$this->Session->read('order.discount'):0);
            $this->set('cart', $this->Session->read('order.cart'));
            $this->set('address_line_1', $this->Session->read('order.address_line_1'));
            $this->set('phone', $this->Session->read('order.phone'));
            $this->set('client',$this->Session->read('order.client'));
            $this->set('country',$this->Session->read('order.country'));
            $this->set('address_line_2',$this->Session->read('order.address_line_2'));
            $this->set('state',$this->Session->read('order.state'));

            $this->set('region',$this->Session->read('order.region'));
            $this->set('poBox',$this->Session->read('order.poBox'));
            $this->set('products', $this->Product->find("list"));
            $this->set('paymentlist',$paymentlist);


        }
    }


    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if($id) {
        	
        	$checkId = $this->Session->check('order');
            if (!empty($checkId)) {
                if ($this->Session->read('order.id') != $id) {
                    $this->Session->delete('order');
                }
            }
            
            $paymentlist = array("Cash on Delivery" => "Cash on Delivery", "bikash" => "bikash",);

            $checkOrder = $this->Session->check('order');
          
           if (empty($checkOrder) || !$checkOrder) {
                $this->Session->write('order.id',$id);
                $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
                $ProductOrder = $this->ProductOrder->find("first", $options);

                $ProductOrder['ProductOrder']['client_detail'] = json_decode($ProductOrder['ProductOrder']['client_detail'], true);
                $ProductOrder['ProductOrder']['shipping_detail'] = json_decode($ProductOrder['ProductOrder']['shipping_detail'], true);
                $ProductOrder['ProductOrder']['order_detail'] = json_decode($ProductOrder['ProductOrder']['order_detail'], true);
					
                
                $client['Client']['details'] = $ProductOrder['ProductOrder']['shipping_detail'];

               
                
                $client['Client']['username'] = $ProductOrder['ProductOrder']['client_detail']["username"];


                $this->Session->write('order.client', $client);
                $this->Session->write('order.fname', $ProductOrder['ProductOrder']['shipping_detail']['fname']);
                $this->Session->write('order.lname', $ProductOrder['ProductOrder']['shipping_detail']['lname']);
                $this->Session->write('order.address_line_1', $ProductOrder['ProductOrder']['shipping_detail']['address_line_1']);
                $this->Session->write('order.address_line_2', $ProductOrder['ProductOrder']['shipping_detail']['address_line_2']);
                $this->Session->write('order.phone', $ProductOrder['ProductOrder']['shipping_detail']['phone']);

                $this->Session->write('order.country', $ProductOrder['ProductOrder']['shipping_detail']['country']);
               // $this->Session->write('order.city', $ProductOrder['ProductOrder']['shipping_detail']['city']);
                $this->Session->write('order.state', $ProductOrder['ProductOrder']['shipping_detail']['state']);
                $this->Session->write('order.region', $ProductOrder['ProductOrder']['shipping_detail']['region']);
                $this->Session->write('order.poBox', $ProductOrder['ProductOrder']['shipping_detail']['poBox']);

                $this->Session->write('order.delivery.payment', $ProductOrder['ProductOrder']['shipping_detail']['paymentMethod']);

                foreach ($ProductOrder['ProductOrder']['order_detail']["cart"] as  $items) {




                    $unit=$items["productQuantity"];

                    $productstring=$items["productId"];

                    $product["Product"]["id"]=$items["productId"];
                    $product["Product"]["title"]=$items["productTitle"];
                    $product["Product"]["price"]=$items["productBasePrice"];
                    $product["Product"]["sale_price"]=$items["productBasePrice"];
                    $product["Product"]["slug"]=$items["productSlug"];




                    $attribute=array();

                    if(sizeof($items["attributes"]))
                    {
                        foreach ($items["attributes"] as $key=> $value)

                        {
                            $productstring.="_".$key."_".$value;

                        }
                        $attribute=$items["attributes"];


                    }


                    $productcart=array (
                        "product"=> $product,
                        "unit"=>$unit,
                        "attribute"=>$attribute

                    );



                    $this->Session->write('order.cart.' . $productstring, $productcart);


                }

           }

            if ($this->request->is('post')) {
                $productid = !empty($this->request->data['ProductOrder']['Product']) ? $this->request->data['ProductOrder']['Product'] : '';

                if ($this->request->data["action"] == "getproduct")
                {
                    $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $productid));
                    $product = $this->Product->find("first", $options);

                    if(sizeof($product["ProductAttribute"]))
                    {
                        $attriobutes=array();
                        for ($i=0;$i<sizeof($product["ProductAttribute"]);$i++)
                        {
                            $productAttribute = $this->Attribute->find(
                                'all',
                                array(
                                    'recursive'=>-1,
                                    'fields'=>array('id','title'),
                                    'contain' => array('AttributeValue'=>array('fields'=>array('id','value'))),
                                    'conditions'=>array('Attribute.id' =>  $product["ProductAttribute"][$i]["attribute_id"])
                                )
                            );
                            $attriobutes[]=$productAttribute;

                        }
                        $this->set('attribute',$attriobutes);


                    }
                    else {
                        $this->set('attribute',0);

                    }

                    return $this->render('admin_get_product');

                }
                else if ($this->request->data["action"] == "add") {


                    $unit = $this->request->data['ProductOrder']['unit'];

                    $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $productid));
                    $product = $this->Product->find("first", $options);

                    $attribute=array();


                    $productstring=$productid;

                    if(!empty($this->request->data['ProductOrder']["attribute"]))
                    {
                        foreach ($this->request->data['ProductOrder']["attribute"] as $key=> $value)

                        {
                            $productstring.="_".$key."_".$value;

                        }
                        $attribute=$this->request->data['ProductOrder']["attribute"];


                    }

                    $productcart=array (
                        "product"=> $product,
                        "unit"=>$unit,
                        "attribute"=>$attribute

                    );


                    $this->Session->write('order.cart.'.$productstring, $productcart);


                } elseif ($this->request->data["action"] == "remove") {
                    $this->Session->delete('order.cart.' . $productid);

                } elseif ($this->request->data["action"] == "reset") {
                    $this->Session->write('order.discount', 0);

                    $this->Session->delete('order.cart');

                } elseif ($this->request->data["action"] == "updateunit") {

                    $unit = $this->request->data['ProductOrder']['unit'];
                    $this->Session->write('order.cart.' . $productid . ".unit", $unit);

                } elseif ($this->request->data["action"] == "discount") {
                    $discount = $this->request->data['ProductOrder']['discount'];
                    $this->Session->write('order.discount', $discount);


                } elseif ($this->request->data["action"] == "order") {
                	//$fname =  $this->request->data['ProductOrder']['fname'];
                	//$lname =  $this->request->data['ProductOrder']['lname'];
                    $address = $this->request->data['ProductOrder']['address_line_1'];
                    $address2 = $this->request->data['ProductOrder']['address_line_2'];
                    $phone = $this->request->data['ProductOrder']['phone'];
                   // $city = $this->request->data['ProductOrder']['city'];
                    $state = $this->request->data['ProductOrder']['state'];
                    $region = $this->request->data['ProductOrder']['region'];
                    $poBox = $this->request->data['ProductOrder']['poBox'];
                    $country = $this->request->data['ProductOrder']['country'];


                    $delivery['payment'] = $this->request->data['ProductOrder']['payment'];
                    //$this->Session->write('order.fname', $fname);
                    //$this->Session->write('order.lname', $lname);
                    $this->Session->write('order.address_line_1', $address);
                    $this->Session->write('order.phone', $phone);
                   // $this->Session->write('order.city', $city);
                    $this->Session->write('order.state', $state);
                    $this->Session->write('order.region', $region);
                    $this->Session->write('order.poBox', $poBox);
                    $this->Session->write('order.address_line_2', $address2);
                    $this->Session->write('order.country', $country);
                    $this->order_product($id);

                } 
            }

            $this->set('discount', $this->Session->read('order.discount')?$this->Session->read('order.discount'):0);
            $this->set('cart', $this->Session->read('order.cart'));
            $this->set('fname', $this->Session->read('order.fname'));
            $this->set('lname', $this->Session->read('order.lname'));
            $this->set('address_line_1', $this->Session->read('order.address_line_1'));
            $this->set('phone', $this->Session->read('order.phone'));
            $this->set('client',$this->Session->read('order.client'));
           // $this->set('city',$this->Session->read('order.city'));
            $this->set('country',$this->Session->read('order.country'));
            $this->set('address_line_2',$this->Session->read('order.address_line_2'));
            $this->set('state',$this->Session->read('order.state'));
            $this->set('orderid', $this->Session->read('order.id'));

            $this->set('region',$this->Session->read('order.region'));
            $this->set('poBox',$this->Session->read('order.poBox'));
            $this->set('products', $this->Product->find("list"));
            $this->set('paymentlist',$paymentlist);



        }
    }


    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        $this->ProductOrder->id = $id;
        if (!$this->ProductOrder->exists()) {
            throw new NotFoundException(__('Invalid product order'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->ProductOrder->delete()) {
            $this->Session->setFlash('The product order has been deleted.', 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash('The product order could not be deleted. Please, try again.', 'default', array('class' => 'alert alert-warning'));
        }
        return $this->redirect(array('action' => 'index'));
    }


    public function admin_update_shipping()
    {
        $this->autoRender = false;
        if ($this->request->is('Post')) {
            $postData = $this->request->data;
            $result = false;
            $data['ProductOrder']['id'] = $postData['id'];
            $data['ProductOrder']['shippingCost'] = $postData['shippingCost'];
            $this->ProductOrder->id = $postData['id'];
            if ($this->ProductOrder->save($data)) {
                $result = true;

            } else {
                $result = false;
            }
            echo json_encode($result);
            exit;
        }

    }

    public function admin_make_processing($id)
    {
        if ($this->request->is('Post')) {
            $this->ProductOrder->id = $id;
            $this->ProductOrder->set(array('status' => 'processing'));
            if ($this->ProductOrder->save()) {
                $this->Session->setFlash('This product status is changed', 'default', array('class' => 'alert alert-success'));

            } else {
                $this->Session->setFlash('Please Try again', 'default', array('class' => 'alert alert-warning'));
            }
            return $this->redirect(array('action' => 'index'));
        }

    }


    public function admin_make_completed($id)
    {
        if ($this->request->is('Post')) {
        	$data = $this->ProductOrder->find('first',array(
                'fields'=>array('order_detail'),'conditions'=>array('ProductOrder.' . $this->Product->primaryKey =>  $id)));
        	$orderDetails = json_decode($data['ProductOrder']['order_detail'],true);
        	//pr($orderDetail);die();
        	$stockIds = array();
        	$productQuantity = array();
        	foreach ($orderDetails['cart'] as $orderDetail){
        		if(in_array($orderDetail['stockId'],$stockIds)){
        			$productQuantity[$orderDetail['stockId']] = ($productQuantity[$orderDetail['stockId']] + $orderDetail['productQuantity']);
        		}else{
        			$productQuantity[$orderDetail['stockId']] = $orderDetail['productQuantity'];
        			$stockIds[] = $orderDetail['stockId'];
        		}
        		   
        	}
        	$i = 0;
        	foreach ($productQuantity as $key => $value){
        		$this->ProductStock->query("UPDATE product_stocks SET sold = (sold + $value), quantity = (quantity - $value) WHERE id = '{$key}'");
        	}
        	 $this->ProductOrder->id = $id;
             $this->ProductOrder->set(array('status' => 'completed', 'complete_date' => date('Y-m-d H:i:s')));


            if ($this->ProductOrder->save()) {
                $this->Session->setFlash('This product status is changed', 'default', array('class' => 'alert alert-success'));

            } else {
                $this->Session->setFlash('Please Try again', 'default', array('class' => 'alert alert-warning'));
            }

            return $this->redirect(array('action' => 'index'));
        }

    }

    public function admin_make_cancelled($id)
    {

        if ($this->request->is('Post')) {
            $this->ProductOrder->id = $id;
            $this->ProductOrder->set(array('status' => 'cancelled', 'complete_date' => date('Y-m-d H:i:s')));
            if ($this->ProductOrder->save()) {
                $this->Session->setFlash('This product status is changed', 'default', array('class' => 'alert alert-success'));

            } else {
                $this->Session->setFlash('Please Try again', 'default', array('class' => 'alert alert-warning'));
            }
            return $this->redirect(array('action' => 'index'));
        }

    }

    public function admin_asignDeliveryMan($id = null) {

        if ($this->request->is(array('post', 'put'))) {
            if ($this->ProductOrder->save($this->request->data)) {
                $this->Session->setFlash('The deliveryman order has been saved.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'order_view',$id,"view"));


            }
        } else {
            $options = array('conditions' => array('Deliveryman.' . $this->Deliveryman->primaryKey => $id));
            $this->request->data = $this->Deliveryman->find('first', $options);
        }

    }



    //get all merchant list
    private function getMerchants()
    {
        $data = ClassRegistry::init('Merchant.Merchant')->find('list', array('fields' => array('id', 'basic_information'), 'conditons' => array('status' => 'active')));

        foreach ($data AS $key => $val) {
            $json_dt = json_decode($val, true);

            $dt[$key] = $json_dt['first_name'] . ' ' . $json_dt['last_name'];
        }
        return $dt;
    }

}
