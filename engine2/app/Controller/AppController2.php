<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{
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
                'controller' => 'dashboards',
                'action' => 'index',
                'admin' => true,
                'plugin' => false
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
                'controller' => 'menus',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'admin_sort_menu']
            ],
            [
                'controller' => 'users',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'roles',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'system_settings',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'site_settings',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'social_networks',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'admin_sort_socialnetwork']
            ]

        ],

        //ecommerece
        'ecommerce' => [
            [
                'controller' => 'brands',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'admin_sort']
            ],
            [
                'controller' => 'industries',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'admin_sort']
            ],

            [
                'controller' => 'categories',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'attributes',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'types',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'stores',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'product_attributes',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'products',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'product_keies',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],

            [
                'controller' => 'attribute_values',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'attribute_labels',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'product_orders',
                'actions' => ['admin_index', 'admin_add', 'admin_edit','admin_send_email', 'admin_delete']
            ],
            [
                'controller' => 'shipping_methods',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ]
        ],


        //shipping
        'shipping' => [
            [
                'controller' => 'countries',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'cities',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],

            [
                'controller' => 'channels',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_generate_channels']
            ],

        ],
        //blog
        'blog' => [
            [
                'controller' => 'blogCategories',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'posts',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'comments',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ]
        ],

        'timeout' => [
            [
                'controller' => 'lookbooks',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'home_blocks',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'galleries',
                'actions' => ['admin_index', 'admin_add', 'admin_edit', 'admin_delete']
            ],
            [
                'controller' => 'clients',
                'actions' => ['admin_index', 'admin_view']
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
        'footer' => 'Footer'
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

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->set('acl_array', $this->acl_array);
        $this->set('status', $this->status);
        $this->set('site_status', $this->site_status);
        $this->set('menu_location', $this->menu_locations);
        $this->set('menu_types', $this->menu_types);
        $this->set('is_deletable', $this->is_deletable);

        $this->set('auth_status', $this->Auth->loggedIn());
        $this->set('auth_user', $this->Auth->user());
        //$this->Auth->alow(array('getDomainCredentials'));


    }

    public function isAuthorized($user = null)
    {

        $permission_array = json_decode($user['Role']['accesslist'], true);

        $permission_array['dashboards']['admin_index'] = 'admin_index';
        //users permission
        $permission_array['users']['admin_change_password'] = 'admin_change_password';
        $permission_array['users']['admin_login'] = 'admin_login';
        $permission_array['users']['admin_signout'] = 'admin_signout';
        $permission_array['types']['admin_ajax_add'] = 'admin_ajax_add';
        $permission_array['types']['admin_ajax_getTypeAttr'] = 'admin_ajax_getTypeAttr';
        $permission_array['types']['admin_ajax_edit'] = 'admin_ajax_edit';

        // for merchant
        //$permission_array['merchants']['admin_login'] = 'admin_login';

        $permission_array['media']['admin_ajax_image_manager'] = 'admin_ajax_image_manager';
        $permission_array['media']['admin_ajax_image_delete'] = 'admin_ajax_image_delete';
        $permission_array['media']['admin_ajax_uploader'] = 'admin_ajax_uploader';

        $permission_array['products']['admin_delete_product_image_by_id'] = 'admin_delete_product_image_by_id';
        $permission_array['product_orders']['admin_make_processing'] = 'admin_make_processing';
        $permission_array['product_orders']['admin_make_completed'] = 'admin_make_completed';
        $permission_array['product_orders']['admin_make_cancelled'] = 'admin_make_cancelled';
        $permission_array['product_orders']['admin_update_shipping'] = 'admin_update_shipping';
        $permission_array['product_orders']['admin_send_email'] = 'admin_send_email';
        $permission_array['supporter']['admin_generate'] = 'admin_generate';
        $permission_array['categories']['admin_sort'] = 'admin_sort';
        $permission_array['categories']['admin_update_special'] = 'admin_update_special';
        $permission_array['brands']['admin_sort'] = 'admin_sort';

        if (isset($permission_array[$this->params['controller']][$this->params['action']])) {
            if ($permission_array[$this->params['controller']][$this->params['action']] == $this->params['action']) {
                return true;
            }
        }
        //$this->Session->setFlash('default','auth', array('class'=>'alert alert-warning'));
        $this->Auth->flash['params']['class'] = 'alert alert-danger';
        return false;
    }



}
