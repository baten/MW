<?php
App::uses('TimeoutAppController', 'Timeout.Controller');

/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SitesController extends TimeoutAppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Session', 'RequestHandler', 'EmailSender', 'Uploader');

    public $uses = array('Timeout.Client', 'Timeout.ClientsOrderStatus','Seller');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();     

    }   

    public function changeCollation(){
        $this->autoRender=false;
        App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('timeout');
        $dbname = $dataSource->config['database'];     
        $results=$this->Client->query('show tables');
       foreach ($results as $key => $value) {
            $tableName = $value['TABLE_NAMES']['Tables_in_'.$dbname];
            $this->Client->query("ALTER TABLE $tableName CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
       }     
       echo "The collation has been successfully changed for database: ".$dbname;
    }
    
     //create forgotpassword token and send mail

    public function forgotpasswordToken(){
        if($this->request->is('post')){
            //$post_data =  $this->request->data;
            $post_data =  $this->request->input('json_decode',true);
            $checkUser = $this->Client->checkValidUser($post_data[0]['value']);
            if(!empty($checkUser)){
                $this->Client->id = $checkUser['Client']['id'];
                $token = $checkUser['Client']['id'].time();
                $str = $token . '~' . $post_data[0]['value'];
                $strPrm = base64_encode($str);
                //pr($strPrm);
                //pr(base64_decode($strPrm));
                if($this->Client->saveField('token', $token)){
                    $Subject = 'Forgotten password request';
                    //mail body
                    $Email = "To change your checknpick password, please click on this link : http://checknpick.com/#/fp/$strPrm " . "\r\n" .
                        "If you did not request this change, you do not need to do anything." ."\r\n" .

                        "Thank you for stay with us."."\r\n" .

                        "Sincerely, "."\r\n" .
                        "checknpick Admin";

                    $To = $post_data[0]['value'];
                    $From = 'info@checknpick.com';
                    $Headers = "From: $From" . "\r\n" .
                        "CC: $From";
                    mail ($To, $Subject, $Email, $Headers, $From);

                    $response['status'] = 'success';
                    $response['message'] = 'Please check your mail.';
                }
            }else{
                $response['status'] = 'error';
                $response['message'] = 'Invalid Username';
            }

            $this->set(
                array(
                    '_serialize',
                    'data' => array('confirmation'=>$response),
                    '_jsonp' => true
                )
            );

            $this->render('json_render');
        }
    }

    //forgot password
    public function createNewPassword(){
        if($this->request->is('post')){
            $post_data =  $this->request->input('json_decode',true);
            $strTokenInfo = explode('~',base64_decode($post_data['tokenInfo']));
            $checkUser = $this->Client->checkValidUser($strTokenInfo[1],$strTokenInfo[0]);
            if(!empty($checkUser)){
                $this->Client->id = $checkUser['Client']['id'];
                $update_data['Client']['password'] = $post_data['password'];
                $update_data['Client']['token'] = '';
                if($this->Client->save($update_data)){
                    $response['status'] = 'success';
                    $response['message'] = 'Password has been updated';
                }else{
                    $response['status'] = 'error';
                    $response['message'] = 'Password can not be updated';
                }
            }else{
                $response['status'] = 'error';
                $response['message'] = 'Invalid Request';
            }

        }else{
            $response['status'] = 'error';
            $response['message'] = 'Invalid Request';
        }
        $this->set(
            array(
                '_serialize',
                'data' => array('data'=>$response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }



    public function client_cart_get()
    {
        $cartData = false;
        if ($this->request->is('post')) {
            //catch post ata
            //$data =  $this->request->data;//input('json_decode',true);
            $data = $this->request->input('json_decode', true);
            if ($data):
                $getData = $this->ClientsOrderStatus->find('first', array(
                    'conditions' => array(
                        'ClientsOrderStatus.client_id' => $data['clientId'],
                        'ClientsOrderStatus.section' => $data['section'],
                    )
                ));

                if ($getData)
                    $cartData = $getData['ClientsOrderStatus'];

            endif;
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('result' => $cartData),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    public function client_cart_remove()
    {
        $cartData = false;
        if ($this->request->is('post')) {
            //catch post ata
            //$data =  $this->request->data;//input('json_decode',true);
            $data = $this->request->input('json_decode', true);
            if ($data):
                $cartData = $this->ClientsOrderStatus->deleteAll(array('ClientsOrderStatus.client_id' => $data['clientId']), false);
            endif;
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('result' => $cartData),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }


    public function client_cart_update()
    {
        $return_data['status'] = false;
        if ($this->request->is('post')) {
            //catch post ata
            //$data =  $this->request->data;//input('json_decode',true);
            $data = $this->request->input('json_decode', true);
            if ($data and ($data['data'] != null)):
                //$data['data'] = json_encode($data['data']);

                //pr($data['data']);

                $prevCartData = $this->ClientsOrderStatus->find('first', array(
                    'conditions' => array(
                        'ClientsOrderStatus.client_id' => $data['clientId'],
                        'ClientsOrderStatus.section' => $data['section'],
                    )
                ));

                if ($prevCartData) {
                    $data['id'] = $prevCartData['ClientsOrderStatus']['id'];
                    $data['datetime'] = date('Y-m-d H:i:s');
                    $data['client_id'] = $data['clientId'];
                    $isSave = $this->ClientsOrderStatus->save($data);
                    if ($isSave) {
                        $return_data['status'] = true;
                        $return_data['code'] = $prevCartData['ClientsOrderStatus']['code'];
                    } else {
                        $return_data['status'] = false;
                    }
                } else {
                    $data['code'] = $data['section'] . time();
                    $data['datetime'] = date('Y-m-d H:i:s');
                    $data['client_id'] = $data['clientId'];
                    $isSave = $this->ClientsOrderStatus->save($data);
                    if ($isSave) {
                        $return_data['status'] = true;
                        $return_data['code'] = $data['code'];
                    } else {
                        $return_data['status'] = false;
                    }
                }
            endif;
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('result' => $return_data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }


    /*
     * cleint registraion
     */
    public function client_registration()
    {

        if ($this->request->is('post')) {
            //$data =  $this->request->data;
            $data = $this->request->input('json_decode', true);
            $cilentData = array();
            foreach ($data as $key => $value) {
                if ($value['name'] != 'repassword') {
                    if ($value['name'] == 'username') {
                        $cilentData['Client'][$value['name']] = $value['value'];
                    } elseif ($value['name'] == 'password') {
                        $cilentData['Client'][$value['name']] = $value['value'];
                    } else {
                        $cilentData['Client']['details'][$value['name']] = $value['value'];
                    }
                }
            }
            
            $from_email = 'info@checknpick.com';
            $from_name = 'checkNpick';

            if(isset($cilentData['Client']['details']['from_email'])){
                $from_email = $cilentData['Client']['details']['from_email'];
                $from_name = $cilentData['Client']['details']['from_name'];
                unset($cilentData['Client']['details']['from_email']);
                unset($cilentData['Client']['details']['from_name']);
            }



            $cilentData['Client']['details'] = json_encode($cilentData['Client']['details']);

            if ($this->Client->find('count', array('conditions' => array('username' => $cilentData['Client']['username']))) > 0) {
                $return_data = array();
                $return_data['status'] = 'error';
                $return_data['message'] = 'Already registered.';
            } else {
                if ($this->Client->save($cilentData)) {
                    //send email
                    
                    $emailConfig['from_email'] = $from_email;
                    $emailConfig['from_name'] = $from_name;
                    $emailConfig['to'] = $cilentData['Client']['username'];
                    $emailConfig['subject'] = 'Registration';
                    $emailConfig['template'] = 'registration';
                    $emailConfig['data'] = $cilentData;
                    $this->EmailSender->sendEmail($emailConfig);


                    $return_data = array();
                    $return_data['status'] = 'success';
                    $return_data['message'] = 'Registration has been completed.';
                } else {
                    $return_data = array();
                    $return_data['status'] = 'error';
                    $return_data['message'] = 'Can not be procced.';
                }
            }

        } else {
            $return_data = array();
            $return_data['status'] = 'error';
            $return_data['message'] = 'Invalid Request.';
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('registerClient' => $return_data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }


    public function client_login()
    {
        $response = array();
        if ($this->request->is('post')) {
            //catch post ata
            //$data =  $this->request->data;//input('json_decode',true);
            $data = $this->request->input('json_decode', true);
            //process data
            $login_data = array();
            foreach ($data as $key => $value) {
                $login_data[$value['name']] = $value['value'];
            }
            //check user auth credential
            $is_valid_user = $this->Client->processLogin($login_data['username'], $login_data['password']);

            if ($is_valid_user != 'error') {
                unset($is_valid_user['Client']['password']);

                $response['status'] = 'success';
                $response['loggeduser'] = $is_valid_user;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Username and Password does not match';
            }

            //block other type of request.
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid Request.';
        }

        //process the view
        $this->set(
            array(
                '_serialize',
                'data' => array('clientLogin' => $response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    /**
     *
     */
    public function client_profile()
    {
        if ($this->request->is('post')) {
            //$data =  $this->request->data;
            $data = $this->request->input('json_decode', true);

            //get current profile
            if ($data['action'] == 'get_data') {

                $profile_data = $this->Client->find(
                    'first',
                    array(
                        'conditions' => array(
                            'id' => $data['clientId']
                        )
                    )
                );

                $this->set(
                    array(
                        '_serialize',
                        'data' => array('clientProfile' => $profile_data),
                        '_jsonp' => true
                    )
                );
            } //update profile
            else {
                //$new_profile_data['Client']['details']= json_encode($data['new_data']);
                $profile_data = array();
                foreach ($data['newData'] as $key => $value) {
                    $profile_data[$value['name']] = $value['value'];
                }
                $new_profile_data['Client']['details'] = json_encode($profile_data);

                $this->Client->id = $data['clientId'];
                if ($this->Client->save($new_profile_data)) {
                    $response['status'] = true;
                    $response['message'] = 'Profile has been updated';
                } else {
                    $response['status'] = false;
                    $response['message'] = 'Profile update failed';
                }
                $this->set(
                    array(
                        '_serialize',
                        'data' => array('clientProfileUpdate' => $response),
                        '_jsonp' => true
                    )
                );
            }

        }


        $this->render('json_render');
    }

    /*
     * check current password
     */
    public function check_current_password()
    {
        if ($this->request->is('post')) {
            //$post_data =  $this->request->data;
            $post_data = $this->request->input('json_decode', true);
            $current_data = $this->Client->find('first', array('conditions' => array('id' => $post_data['clientId'])));
            $password_is_valid = $this->Client->processLogin($current_data['Client']['username'], $post_data['currentPassword']);
            if ($password_is_valid == 'error') {
                $password_validation['message'] = 'Password does not match';
            } else {
                $password_validation['message'] = '';
            }
        } else {
            $password_validation['message'] = 'Invalid request';
        }
        $this->set(
            array(
                '_serialize',
                'data' => array('clientPasswordCheck' => $password_validation),
                '_jsonp' => true
            )
        );

        $this->render('json_render');

    }

    /**
     * update password
     */
    public function update_password()
    {
        if ($this->request->is('post')) {
            //$post_data =  $this->request->data;
            $post_data = $this->request->input('json_decode', true);
            $this->Client->id = $post_data['clientId'];
            $update_data['Client']['password'] = $post_data['newPassword'];
            if ($this->Client->save($update_data)) {
                $response['status'] = true;
                $response['message'] = 'Password has been updated';
            } else {
                $response['status'] = false;
                $response['message'] = 'Password can not be updated';
            }

        } else {
            $response['message'] = 'Invalid Request';
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('clientUpdatePassword' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }


    /**
     * get brands
     */

    public function getBrands()
    {
        $response = ClassRegistry::init('Ecommerce.Brand')->find('list', array('conditions' => array('status' => 'active')));

        $this->set(
            array(
                '_serialize',
                'data' => array('brandList' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }

    //look book
    public function lookbook()
    {
        $response = ClassRegistry::init('Timeout.Lookbook')->find('all', array('order' => array('order' => 'asc')));
        $this->set(
            array(
                '_serialize',
                'data' => array('lookbook' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }

    //look book
    public function homeblock()
    {
        $response = ClassRegistry::init('Timeout.HomeBlock')->find('all');//,array('order'=>array('order'=>'asc')));
        $this->set(
            array(
                '_serialize',
                'data' => array('homeblock' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }

    //look book
    public function gallery()
    {
        $response = ClassRegistry::init('Timeout.Gallery')->find('all', array('conditions' => array('is_special' => 0)));//,array('order'=>array('order'=>'asc')));
        $this->set(
            array(
                '_serialize',
                'data' => array('gallery' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }

    public function special_gallery()
    {
        $response = ClassRegistry::init('Timeout.Gallery')->find('all', array('conditions' => array('is_special' => 1)));//,array('order'=>array('order'=>'asc')));
        $this->set(
            array(
                '_serialize',
                'data' => array('gallery' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }


    public function sendMail()
    {
        if ($this->request->is('POST')) {
            //$postData = $this->request->data;
            $postData = $this->request->input('json_decode', true);

            $emailConfig['from_email'] = $postData['data'][0]['value']; //'joopdeyn@msn.com';
            $emailConfig['from_name'] = $postData['data'][1]['value'];
            $emailConfig['to'] = $postData['data'][5]['value'];
            $emailConfig['subject'] = $postData['data'][3]['value'];
            $emailConfig['template'] = 'enquiry';
            $emailConfig['data'] = $postData['data'];


            $this->EmailSender->sendEmail($emailConfig);
            $response['status'] = true;
            $response['message'] = "Mail has been sent.";

        } else {
            $response['status'] = false;
            $response['message'] = "Invalid Request.";

        }

        $this->set(
            array(
                '_serialize',
                'data' => array('sendEmail' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }



     public function sellerMail(){
        if ($this->request->is('POST')) {
            //$postData = $this->request->data;
            $postData = $this->request->input('json_decode', true);

            $sellerData = array();
            foreach($postData['data'] as $k=>$v){
                $sellerData['Seller'][$v['name']] = $v['value'];
            }

            if($sellerData['Seller']['industry_id']){
                $sellerData['Seller']['industry_id'] = json_encode($sellerData['Seller']['industry_id']);
            }

            $this->Seller->create();
            if ($this->Seller->save($sellerData)) {


                $emailConfig['from_email'] = $sellerData['Seller']['email'];
                $emailConfig['from_name'] =  $sellerData['Seller']['company_name'];
                $emailConfig['to'] =  $sellerData['Seller']['to'];
                $emailConfig['subject'] = 'New Message from '.$sellerData['Seller']['company_name'].'  for Become a seller.';
                $emailConfig['template'] = 'becomeaseller';
                $emailConfig['data'] = $sellerData['Seller'];


                $this->EmailSender->sendEmail($emailConfig);
                $response['status'] = true;
                $response['message'] = "Mail has been sent.";

            } else {

                $response['status'] = false;
                $response['message'] = "Invalid Request.";
            }

        } else {
            $response['status'] = false;
            $response['message'] = "Invalid Request.";

        }

        $this->set(
            array(
                '_serialize',
                'data' => array('sendEmail' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }


    public function sendQuotation()
    {

        if ($this->request->is('POST')) {
            $emailConfig = array();
            $files = $_FILES;
            $emailConfig = $_REQUEST;

            if(isset($emailConfig['quotationCopy']) and ($emailConfig['quotationCopy'] == 1)){
                $emailConfig['cc'] = $emailConfig['from_email'];
            }

            if (isset($files['add_attachment']['size']) and $files['add_attachment']['size'] > 0) {
                $image_name = time();
                $img_extension = $this->Uploader->getFileExtension($files['add_attachment']);

                $fileOrImage = 2;

                $isUpload = $this->Uploader->upload($files['add_attachment'], $image_name, $img_extension, 'quotation', $fileOrImage, $height = null, $width = null, $oldfile = null);

                if ($isUpload) {
                    $filePath = FULL_BASE_URL.$this->webroot.'img/site/quotation/'.$image_name.'.'.$img_extension;
                    $emailConfig['attachments'] = array('name' => $image_name, 'file_path' => $filePath);
                }

            }

            $emailConfig['data'] = $emailConfig;
            $emailConfig['template'] = 'quotation';

            //pr($emailConfig);

            $this->EmailSender->sendEmail($emailConfig);


            $response['status'] = true;
            $response['message'] = "Mail has been sent.";


        } else {
            $response['status'] = false;
            $response['message'] = "Invalid Request.";

        }

        $this->set(
            array(
                '_serialize',
                'data' => array('sendEmail' => $response),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }

     public function beforeRender()
    {
        parent::beforeRender();
        $this->response->header('Access-Control-Allow-Origin', '*');
    }


}