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
        'Ecommerce.ProductKeie'
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


    public function send_email()
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $emailConfig = $data['ProductOrder'];
            $emailConfig['from_name'] = 'Checknpick Admin.';
            $emailConfig['from_email'] = 'info@checknpick.com';


            if (isset($emailConfig['attached']['size']) and $emailConfig['attached']['size'] > 0) {
                $image_name = time();
                $img_extension = $this->Uploader->getFileExtension($emailConfig['attached']);

                $fileOrImage = 2;

                $isUpload = $this->Uploader->upload($emailConfig['attached'], $image_name, $img_extension, 'quotation', $fileOrImage, $height = null, $width = null, $oldfile = null);

                if ($isUpload) {
                    $filePath = FULL_BASE_URL . $this->webroot . 'img/site/quotation/' . $image_name . '.' . $img_extension;
                    $emailConfig['attachments'] = array('name' => $image_name, 'file_path' => $filePath);
                }
            }

            $emailConfig['data'] = $emailConfig;
            $emailConfig['template'] = 'order';

            $isSend = $this->EmailSender->sendEmail($emailConfig);

            if ($isSend) {
                $this->Session->setFlash('Mail has been sent.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Mail not sent.', 'default', array('class' => 'alert alert-danger'));
                return $this->redirect($this->referer());
            }
        }
    }


    public function admin_index()
    {
        $this->ProductOrder->recursive = 0;
        $this->ProductOrder->order = array('ProductOrder.order_date' => 'DESC');

        if ($this->request->is('post')) {

            $this->paginate = array(
                'conditions' => array(
                    'OR' => array(
                        "ProductOrder.order_code LIKE '%" . $this->request->data['ProductOrder']['keywords'] . "%'"
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


    public function admin_assignkey($id = null, $product_id = null, $quantity = null, $attribute_id = null,$attribute_value_id = null)
    {

        $this->layout = false;


        if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->ProductOrder->id = $id;

            $data = $this->request->data;
            $productOrderData = $this->ProductOrder->find('first',array('fields'=>array('product_keys'), 'conditions'=>array('id'=>$id)));

            if(isset($productOrderData['ProductOrder']['product_keys']) and !empty($productOrderData['ProductOrder']['product_keys'])){
                $newProductKeysArray = array();

                $productKeys = json_decode($productOrderData['ProductOrder']['product_keys'], true);
                $newProductKeys = json_decode($data['ProductOrder']['product_keys'], true);

                $newProductKeysArray = array_merge($productKeys,$newProductKeys);



                $data['ProductOrder']['product_keys'] = json_encode($newProductKeysArray);
            }

            $this->ProductOrder->id = $id;
            if ($this->ProductOrder->save($data)) {

                $updateProductKeys = json_decode($data['ProductOrder']['product_keys'], true);

                $productKeyArray = array();

                foreach($updateProductKeys as $key=>$val){
                    $productKeyArray = array_merge($productKeyArray, array_keys($val));
                }

                $this->ProductKeie->updateAll(
                    array('ProductKeie.status' => 1),
                    array('ProductKeie.id' => $productKeyArray)
                );

                $this->Session->setFlash('The product order has been saved.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'order_view', $id));
            } else {
                $this->Session->setFlash('The product order could not be saved. Please, try again.', 'default', array('class' => 'alert alert-warning'));
            }
        }



//        $product = $this->Product->getProductKey($product_id, $quantity);

        $product = $this->Product->find('first', array(
            'fields' => array('Product.title', 'Product.product_code',),
            'contain' => array(
                'ProductKeie' => array(
                    'conditions' => array(
                        'ProductKeie.attribute_id' => $attribute_id,
                        'ProductKeie.attribute_value_id' => $attribute_value_id,
                        'ProductKeie.status' => 0
                    ),
                    'limit' => $quantity
                )
            ),
            'conditions' => array('Product.id' => $product_id)
        ));


        if(isset($product['ProductKeie'])) {
            $availableKey = sizeof($product['ProductKeie']);

            if ($quantity != $availableKey) {
                $product['ProductKeie'] = array();
            }
        }


        $this->set(compact('product', 'id','attribute_id','attribute_value_id'));


    }


    public function admin_order_view($id = null, $page = 'view')
    {
        // $this->layout = false;
        //$this->autoRender = false;

        if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
        $order_data = $this->ProductOrder->find('first', $options);


        $data['client'] = json_decode($order_data['ProductOrder']['client_detail'], true);
        $data['client_details'] = json_decode($data['client']['Client']['details'], true);
        $data['order_detail'] = json_decode($order_data['ProductOrder']['order_detail'], true);
        $data['shipping_detail'] = json_decode($order_data['ProductOrder']['shipping_detail'], true);
        $data['product_keys'] = json_decode($order_data['ProductOrder']['product_keys'], true);
        $data['shipping_cost'] = ($order_data['ProductOrder']['shipping_cost']);
        $data['payment_detail'] = ($order_data['ProductOrder']['payment_detail']);
        $data['payment_status'] = ($order_data['ProductOrder']['status']);
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

            /*
              $doc_name = '';
              $author = '';
              $title = '';
              $subject = '';
              $keywords = '';
              $font_size = '12';
              $font_name = '';
             */

            $pdfdata['generate_type'] = $page;
            $pdfdata['html'] = $this->render($this->params['action']);
            $pdfdata['title'] = 'Order Invoice';
            $pdfdata['print_content_with_logo'] = true;
//
//            if (isset($this->request->data['print_content_title'])) {
//                $pdfdata['title'] = $this->request->data['print_content_title'];
//            }
//            if (isset($this->request->data['print_content_with_logo']))
//                $pdfdata['print_content_with_logo'] = $this->request->data['print_content_with_logo'];
//
//            if (isset($this->request->data['font_size']))
//                $pdfdata['font_size'] = null;


            $this->Session->write('pdfdata', $pdfdata);
            if ($this->request->is('ajax')) {
                echo true;
                exit;
            }
            $this->redirect(array('plugin' => false, 'controller' => 'supporter', 'action' => 'generate'));
        }
    }

   


    public function order_view($id = null, $page = 'view')
    {
        // $this->layout = false;
        //$this->autoRender = false;

        if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
        $order_data = $this->ProductOrder->find('first', $options);


        $data['client'] = json_decode($order_data['ProductOrder']['client_detail'], true);
        $data['client_details'] = json_decode($data['client']['Client']['details'], true);
        $data['order_detail'] = json_decode($order_data['ProductOrder']['order_detail'], true);
        $data['shipping_detail'] = json_decode($order_data['ProductOrder']['shipping_detail'], true);
        $data['product_keys'] = json_decode($order_data['ProductOrder']['product_keys'], true);
        $data['shipping_cost'] = ($order_data['ProductOrder']['shipping_cost']);
        $data['payment_detail'] = ($order_data['ProductOrder']['payment_detail']);
        $data['payment_status'] = ($order_data['ProductOrder']['status']);
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

            /*
              $doc_name = '';
              $author = '';
              $title = '';
              $subject = '';
              $keywords = '';
              $font_size = '12';
              $font_name = '';
             */

            $pdfdata['generate_type'] = $page;
            $pdfdata['html'] = $this->render($this->params['action']);
            $pdfdata['title'] = 'Order Invoice';
            $pdfdata['print_content_with_logo'] = true;
//
//            if (isset($this->request->data['print_content_title'])) {
//                $pdfdata['title'] = $this->request->data['print_content_title'];
//            }
//            if (isset($this->request->data['print_content_with_logo']))
//                $pdfdata['print_content_with_logo'] = $this->request->data['print_content_with_logo'];
//
//            if (isset($this->request->data['font_size']))
//                $pdfdata['font_size'] = null;


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
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->ProductOrder->create();
            if ($this->ProductOrder->save($this->request->data)) {
                $this->Session->setFlash('The product order has been saved.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The product order could not be saved. Please, try again.', 'default', array('class' => 'alert alert-warning'));
            }
        }
        //$this->set('merchants',$this->getMerchants());
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
        if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ProductOrder->save($this->request->data)) {
                $this->Session->setFlash('The product order has been saved.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The product order could not be saved. Please, try again.', 'default', array('class' => 'alert alert-warning'));
            }
        } else {
            $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
            $this->request->data = $this->ProductOrder->find('first', $options);
        }

        //$this->set('merchants',$this->getMerchants());
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
            $data['ProductOrder']['shipping_cost'] = $postData['shippingCost'];
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
