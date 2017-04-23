<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{

	public $uses = array('Notification','Ecommerce.ProductOrder','Timeout.Client');
	
    public $langsName;
    public $numberOfProductsPerPage = 15;
    //all components
    public $components = array(
        'Uploader',
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => true,
                'plugin' => false
            ),
            'loginRedirect' => array(
                'controller' => 'products',
                'action' => 'index',
                'admin' => true,
                'plugin' => "ecommerce"
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => true,
                'plugin' => false
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            'authorize' => array('Controller'),
            //'authError' => 'You don\'t have permission to access those area.',
        ),
        'RequestHandler'
    );


    public function getDomainCredentials()
    {


    }

    public $acl_array = [
        //cms
        'cms' => [
            [
                'controller' => 'web_pages',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
            'controller' => 'web_page_details',
            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'menus',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'admin_sort_menu']
            ],
            [
                'controller' => 'users',
                'actions' => ['admin_index','admin_clientIndex','admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'roles',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
            'controller'	=> 'subscribers',
            'actions'		=> ['admin_index','admin_delete']
            ],
            [
            'controller'	=> 'subscriber_notifications',
            'actions'		=> ['admin_index','admin_add','admin_edit','admin_delete']
            ],
            [
            'controller'	=> 'subscriber_notification_details',
            'actions'		=> ['admin_index']
            ],
           /*  [
                'controller' => 'system_settings',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ], */
            [
                'controller' => 'site_settings',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
            'controller' => 'overviews',
            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'social_networks',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'admin_sort_socialnetwork']
            ],
            [
            'controller' => 'notifications',
            'actions' => ['admin_index','admin_view']
            ],
            [
            'controller' => 'currency_values',
            'actions' => ['admin_index','admin_edit']
            ],
            /* [
                'controller' => 'partners',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ] */

        ],

        //ecommerece
        'ecommerce' => [         
            [
                'controller' => 'categories',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
	            'controller' => 'brands',
	            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
            'controller' => 'teams',
            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
           /*  [
            'controller' => 'sports',
            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ], */
            [
	            'controller' => 'attributes',
	            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete','admin_sort_attribute']
            ],
           /*  [
                'controller' => 'attributes',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'types',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],           
            [
                'controller' => 'product_attributes',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            */
            [
	            'controller' => 'merchants',
	            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete','admin_view']
            ],
            
            [
                'controller' => 'products',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete','admin_stockreport','admin_salereport','admin_product_settings','admin_excelImport']
            ],
            [
            'controller' => 'product_stocks',
            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete','admin_view','admin_export','admin_import']
            ],
            /*
            [
            'controller' => 'stocks',
            'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete','admin_view']
            ],
            [
            'controller' => 'sales',
            'actions' => ['admin_index']
            ],         
            [
                'controller' => 'attribute_values',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'attribute_labels',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ], */
            [
                'controller' => 'product_orders',
                'actions' => ['admin_order_view','admin_index', 'admin_add', 'admin_edit','admin_send_email', 'admin_delete','admin_unview',"admin_asignDeliveryMan"]
            ] ,         
            [
                'controller' => 'coupons',
                'actions' => ['admin_index', 'admin_add', 'admin_edit','admin_delete']
            ],           
           /*  [
                'controller' => 'toppers',
                'actions' => ['admin_index', 'admin_add', 'admin_edit','admin_delete']
            ],
            [
                'controller' => 'reservations',
                'actions' => ['admin_index', 'admin_accept', 'admin_reject', 'admin_delete']
            ]   */
            [
                'controller' => 'deliverymen',
                'actions' => ['admin_index', 'admin_add', 'admin_edit','admin_delete','admin_view']
            ],
            [
                'controller' => 'purchases',
                'actions' => ['admin_index', 'admin_add', 'admin_edit','admin_delete','admin_view']
            ],
            [
                'controller' => 'demages',
                'actions' => ['admin_index', 'admin_add', 'admin_recover','admin_delete','admin_view']
            ],
            [
                'controller' => 'expense_titles',
                'actions' => ['admin_index', 'admin_add', 'admin_edit','admin_delete','admin_view']
            ],
            [
                'controller' => 'expenses',
                'actions' => ['admin_index', 'admin_add', 'admin_edit','admin_delete','admin_view']
            ]
        ],
       'shipping' => [
			[
				'controller'	=> 'countries',
				'actions'		=> ['admin_index','admin_add','admin_edit','admin_delete']
			],
			[
				'controller'	=> 'states',
				'actions'		=> ['admin_index','admin_add','admin_edit','admin_delete']
			],
			[
				'controller'	=> 'cities',
				'actions'		=> ['admin_index','admin_add','admin_edit','admin_delete']
			],
			
			[
				'controller'	=> 'channels',
				'actions'		=> ['admin_index','admin_add','admin_edit','admin_generate_channels']
			]
		],
        'customer' => [            
            [
                'controller' => 'banners',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            /* [
                'controller' => 'galleries',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ], */
            [
                'controller' => 'clients',
                'actions' => ['admin_index', 'admin_view','admin_add', 'admin_edit']
            ]
        ]
    ];

    public $site_status = [
        'development' => 'Development',
        'maintenance' => 'Maintenance',
        'live' => 'Live'
    ];

    public $status = [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'draft' => 'Draft'
    ];
    //menus
    public $menu_locations = [
        'header' => 'Header',
        'main' => 'Main',
        'left' => 'Left',
        'right' => 'Right',
        'footer_top' => 'Footer Top',
        'footer' => 'Footer',
        'about' => 'About'
    ];
    public $menu_types = [
        'content' => 'Web Page',
        'static' => 'Static',
        'functional' => 'Functional',
        'external' => 'External',
    ];

    public $is_deletable = [
        'yes' => 'Yes',
        'no' => 'No'
    ];
    public $food_item=[
        'vegan'     =>'vegan',
        'chicken'   =>'chicken',
        'beef'      =>'beef',
        'fish'      =>'fish',
        'pork'      =>'pork',
        'mix'       =>'mix'
    ];
    public $spicy_level=[
        'spicy'     =>'spicy',
        'medium'    =>'medium',
        'high'      =>'high'
    ];
    
    
    public function beforeFilter()
    {
        parent::beforeFilter();  
        $this->langsName =$this->Session->read('langsName'); 
      
        if(empty($this->langsName)){
           $this->langsName='English';         
        }   
        $this->set('acl_array', $this->acl_array);
        $this->set('status', $this->status);
        $this->set('site_status', $this->site_status);
        $this->set('menu_location', $this->menu_locations);
        $this->set('menu_types', $this->menu_types);
        $this->set('is_deletable', $this->is_deletable);

        $this->set('auth_status', $this->Auth->loggedIn());
        $this->set('auth_user', $this->Auth->user());
        //$this->Auth->allow(array('index'));
        $this->set('langsName',$this->langsName);
        //$this->set('numFormatObj',new \NumberFormatter("de-DE", \NumberFormatter::DECIMAL));
        
        $unviewdorders=$this->ProductOrder->find('count',array('conditions' => array('ProductOrder.view_status' => '0')));
        $this->set('unviewdorders',$unviewdorders);
        
        $newcustomer=$this->Client->find('count',array('conditions' => array('Client.view_status' => 0 )));
        $this->set('newcustomer',$newcustomer);
    }

    public function isAuthorized($user = null)
    {

        $permission_array = json_decode($user['Role']['accesslist'], true);

        $permission_array['dashboards']['admin_index'] = 'admin_index';
        //users permission
        $permission_array['users']['admin_change_password'] = 'admin_change_password';
        $permission_array['users']['admin_login'] = 'admin_login';
        $permission_array['users']['admin_signout'] = 'admin_signout';
        $permission_array['attributes']['admin_ajax_add'] = 'admin_ajax_add';
        $permission_array['attributes']['admin_ajax_edit'] = 'admin_ajax_edit';
        $permission_array['attributes']['admin_ajax_setAttrUseForStck'] = 'admin_ajax_setAttrUseForStck';
        
        $permission_array['product_keies']['admin_get_product_attributes'] = 'admin_get_product_attributes';

        // for merchant
        //$permission_array['merchants']['admin_login'] = 'admin_login';
        
        
        //for editor image 
        $permission_array['media']['admin_ajax_image_manager'] = 'admin_ajax_image_manager';
        $permission_array['media']['admin_ajax_image_delete'] = 'admin_ajax_image_delete';
        $permission_array['media']['admin_ajax_uploader'] = 'admin_ajax_uploader';

        $permission_array['channels']['admin_ajax_getCities'] = 'admin_ajax_getCities';
        $permission_array['products']['admin_ajax_getStates'] = 'admin_ajax_getStates';
        
       // $permission_array['media']['admin_ajax_image_delete'] = 'admin_ajax_image_delete';
       // $permission_array['media']['admin_ajax_uploader'] = 'admin_ajax_uploader';
       
        $permission_array['product_stocks']['admin_update_stockQuantity'] = 'admin_update_stockQuantity';
        
        $permission_array['products']['admin_delete_product_image_by_id'] = 'admin_delete_product_image_by_id';
        $permission_array['product_orders']['admin_make_processing'] = 'admin_make_processing';
        $permission_array['product_orders']['admin_make_completed'] = 'admin_make_completed';
        $permission_array['product_orders']['admin_make_cancelled'] = 'admin_make_cancelled';
        $permission_array['product_orders']['admin_update_shipping'] = 'admin_update_shipping';
        $permission_array['product_orders']['admin_send_email'] = 'admin_send_email';
        $permission_array['product_orders']['admin_order_view'] = 'admin_order_view';
        $permission_array['product_orders']['admin_assignkey'] = 'admin_assignkey';
        $permission_array['supporter']['admin_generate'] = 'admin_generate';
        $permission_array['categories']['admin_sort'] = 'admin_sort';
        $permission_array['categories']['admin_update_special'] = 'admin_update_special';
        $permission_array['categories']['admin_update_featured'] = 'admin_update_featured';
        $permission_array['brands']['admin_sort'] = 'admin_sort';
        $permission_array['purchases']['admin_add_to_stock'] = 'admin_add_to_stock';

        if (isset($permission_array[$this->params['controller']][$this->params['action']])) {
            if ($permission_array[$this->params['controller']][$this->params['action']] == $this->params['action']) {
                return true;
            }
        }
        //$this->Session->setFlash('default','auth', array('class'=>'alert alert-warning'));
        $this->Auth->flash['params']['class'] = 'alert alert-danger';
        return false;
    }

    /*public function appError($error) {
        $this->redirect('/catch-all-route',301,false);
    }*/

}