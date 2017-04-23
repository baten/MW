<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');


/**
 * Brands Controller
 *
 * @property Brand $Brand
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SitesController extends EcommerceAppController
{

    //merchantid = 25227
    //r8MRx39ZzNw6m5PEs7b4DYa67CtFf8d3WGj45Key

    /**
     * Components
     *
     * @var array
     */
    public $components = array('RequestHandler', 'Ecommerce.Icepay', 'EmailSender');

    public $uses = array(
        'Ecommerce.Category',
        'Ecommerce.ProductCategory',
        'Ecommerce.Brand',
        'Ecommerce.Industry',
        'Ecommerce.ProductIndustry',
        'Ecommerce.Product',
        'Ecommerce.ProductKeie',
        'Ecommerce.Store',
        'Ecommerce.Type',
        'Ecommerce.Attribute',
        'Ecommerce.ProductOrder',
        'Ecommerce.Store',
        'Ecommerce.TypeCategory',
    	'Ecommerce.Stock',
    	'Ecommerce.Sale'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

   
   public function changeCollation(){
        $this->autoRender=false;
        App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('ecommerce');
        $dbname = $dataSource->config['database'];     
        $results=$this->Category->query('show tables');
       foreach ($results as $key => $value) {
            $tableName = $value['TABLE_NAMES']['Tables_in_'.$dbname];
            $this->Category->query("ALTER TABLE $tableName CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
       }     
       echo "The collation has been successfully changed for database: ".$dbname;
    }


    /*
     * barnd list
    */
    public function brand_list()
    {
        if ($this->request->is('get')) {
            $data = $this->Brand->find('list', array('conditions' => array('status' => 'active')));
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceBrands' => $data),
                    '_jsonp' => true

                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceBrands' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }
        $this->render('json_render');
    }

    /*
     * Industry list
    */
    public function industry_list()
    {
        if ($this->request->is('get')) {
            $data = $this->Industry->find('list', array('conditions' => array('status' => 'active')));
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceIndustry' => $data),
                    '_jsonp' => true

                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceIndustry' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }
        $this->render('json_render');
    }

    /*
     * Featured Industry list
    */
    public function feature_industry_list()
    {
        if ($this->request->is('get')) {
            $industry = $this->Industry->find('list', array('limit' => 6, 'conditions' => array('status' => 'active', 'is_featured' => 1), 'order' => array('Industry.order' => 'ASC')));

            $industryProducts = $this->ProductIndustry->find(
                'all',
                array(
                    'recursive' => 1,
                    'fields' => array('ProductIndustry.industry_id', 'Product.id', 'Product.title', 'Product.rank'),
                    'conditions' => array(
                        'ProductIndustry.industry_id' => array_keys($industry),
                        'Product.status' => 'active'
                    ),

                ));


            $data = array();
            if (is_array($industryProducts) and !empty($industryProducts)) {
                foreach ($industryProducts as $key => $product) {
                    $industry_id = $product['ProductIndustry']['industry_id'];
                    $data[$industry_id]['industry_title'] = $industry[$industry_id];
                    $data[$industry_id]['industryProducts'][] = $product['Product'];
                }
            }

            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceIndustry' => $data),
                    '_jsonp' => true

                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceIndustry' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }
        $this->render('json_render');
    }


    /*
     * Featured Category list
    */
    public function feature_category_list()
    {
        if ($this->request->is('get')) {
            $category = $this->Category->find('list', array( 'conditions' => array('status' => 'active', 'is_special' => 1), 'order' => array('Category.order' => 'ASC')));


            $categoryPaidProducts = $this->ProductCategory->find(
                'all',
                array(
                    'recursive' => 1,
                    'fields' => array('ProductCategory.category_id', 'Product.id', 'Product.title', 'Product.rank'),
                    'conditions' => array(
                        'ProductCategory.category_id' => array_keys($category),
                        'Product.is_free ' => 0,
                        'Product.status' => 'active'
                    ),
                ));



            $paidData = array();
            if (is_array($categoryPaidProducts) and !empty($categoryPaidProducts)) {
                foreach ($categoryPaidProducts as $key => $product) {
                    $industry_id = $product['ProductCategory']['category_id'];
                    $paidData[$industry_id]['category_title'] = $category[$industry_id];
                    $paidData[$industry_id]['categoryProducts'][] = $product['Product'];

                    if(isset($paidData[$industry_id]['category_product_count'])){
                        $paidData[$industry_id]['category_product_count'] += 1;
                    }else {
                        $paidData[$industry_id]['category_product_count'] = 1;
                    }
                }
            }






            /***    Category Free Software    ***/
            $categoryFreeProducts = $this->ProductCategory->find(
                'all',
                array(
                    'recursive' => 1,
                    'fields' => array('ProductCategory.category_id', 'Product.id', 'Product.title', 'Product.rank'),
                    'conditions' => array(
                        'ProductCategory.category_id' => array_keys($category),
                        'Product.is_free ' => 1,
                        'Product.status' => 'active'
                    ),
                ));



            $freeData = array();
            if (is_array($categoryFreeProducts) and !empty($categoryFreeProducts)) {
                foreach ($categoryFreeProducts as $key => $product) {
                    $id = $product['ProductCategory']['category_id'];
                    $freeData[$id]['category_title'] = $category[$id];
                    $freeData[$id]['categoryProducts'][] = $product['Product'];

                    if(isset($freeData[$id]['category_product_count'])){
                        $freeData[$id]['category_product_count'] += 1;
                    }else {
                        $freeData[$id]['category_product_count'] = 1;
                    }
                }
            }

            $numberOfFreeProducts = $this->Product->find(
                'count',
                array(
                    'recursive' => 0,
                    'conditions' => array(
                        'Product.is_free ' => 1,
                        'Product.status' => 'active'
                    ),
                ));
            $numberOfPaidProducts = $this->Product->find(
                'count',
                array(
                    'recursive' => 0,
                    'conditions' => array(
                        'Product.is_free ' => 0,
                        'Product.status' => 'active'
                    ),
                ));


            $data = array(
              'paidSoftware' => array('numberOfProduct'=> $numberOfPaidProducts, 'category'=>$paidData),
              'freeSoftware' => array('numberOfProduct'=> $numberOfFreeProducts, 'category'=>$freeData),
            );


            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategory' => $data),
                    '_jsonp' => true

                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceIndustry' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }
        $this->render('json_render');
    }


    public function brand_list_image()
    {
        if ($this->request->is('get')) {
            $data = $this->Brand->find(
                'all',
                array(
                    'conditions' => array(
                        'status' => 'active'
                    ),
                    'fields' => array(
                        'id', 'image_extension', 'title', 'description'
                    ),
                    'recursive' => -1
                )
            );
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceBrands' => $data),
                    '_jsonp' => true

                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceBrands' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }
        $this->render('json_render');
    }


    /*
     * category list
    */
    public function category_list()
    {
        if ($this->request->is('get')) {
            $data = $this->Category->find('list', array('conditions' => array('status' => 'active')));
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => $data),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }

    /**
     * get search product list
     */
    public function search_product_list()
    {
        if ($this->request->is('POST')) {
            //$postData = $this->request->data;
            $postData = $this->request->input('json_decode', true);


            if (isset($postData['searchText'])) {
                $searchText = '%' . strtolower($postData['searchText']) . '%';
            } else {
                $searchText = '';
            }

            if (isset($postData['searchIndustry'])) {
                $searchIndustry = $postData['searchIndustry'];
            } else {
                $searchIndustry = '';
            }


            if (isset($postData['pageNo'])) {
                $page = $postData['pageNo'];
            } else {
                $page = 1;
            }

            // limit
            if (isset($postData['limit']) and !empty($postData['limit'])) {
                $limit = $postData['limit'];
            } else {
                $limit = 20;
            }

            //order
            if (isset($postData['productOrderBy']) and !empty($postData['productOrderBy'])) {
                $productOrderBy = $postData['productOrderBy'];
            } else {
                $productOrderBy = 'asc';
            }

            if (isset($postData['productSortBy']) and !empty($postData['productSortBy'])) {
                $productSortBy = $postData['productSortBy'];
            } else {
                $productSortBy = 'created';
            }


            $data = $this->Product->find(
                'all',
                array(
                    'conditions' => array('Product.title like ' => $searchText, 'Product.status' => 'active'),
                    'order' => array($productSortBy => $productOrderBy),
                    'limit' => $limit,
                    'page' => $page
                )
            );




            $productList = array();
            foreach ($data as $key => $val) {

                if ($searchIndustry) {

                    /*

                    $productIndustryArrayLength = sizeof($val['ProductIndustry']);

                    if ($productIndustryArrayLength) {

                        foreach ($val['ProductIndustry'] as $industryKey => $industryVal) {
                            if ($industryVal['industry_id'] == $searchIndustry) {
                                $checkData = json_decode($val['Product']['options'], true);
                                $val['Product']['options'] = $checkData;
                                array_push($productList, $val);

                                break;
                            }
                        }
                    }
                    */

                    $productCategoryArrayLength = sizeof($val['ProductCategory']);

                    if ($productCategoryArrayLength) {

                        foreach ($val['ProductCategory'] as $industryKey => $industryVal) {
                            if ($industryVal['category_id'] == $searchIndustry) {
                                $checkData = json_decode($val['Product']['options'], true);
                                $val['Product']['options'] = $checkData;
                                array_push($productList, $val);

                                break;
                            }
                        }
                    }

                } else {
                    $checkData = json_decode($val['Product']['options'], true);
                    $val['Product']['options'] = $checkData;
                    array_push($productList, $val);
                }
            }

            if ($searchIndustry) {
                $noOfProducts = sizeof($productList);
            } else {
                $noOfProducts = $this->Product->find('count',
                    array(
                        'conditions' => array('Product.title like ' => $searchText, 'Product.status' => 'active')
                    )
                );
            }


            $pageNo = $this->paginationCalculator($noOfProducts, $limit);
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceProductList' => $productList, 'paginagtion' => $pageNo, 'noOfProducts' => $noOfProducts),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceProductList' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }

    public function search_category_list()
    {
        if ($this->request->is('POST')) {
            $postData = $this->request->input('json_decode', true);


            if (isset($postData['searchText'])) {
                $searchText = '%' . $postData['searchText'] . '%';
            } else {
                $searchText = '';
            }

            $data = $this->Category->find('list', array('conditions' => array('Category.title like ' => $searchText, 'Category.status' => 'active')));
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => $data),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }


    public function category_all_list()
    {
        if ($this->request->is('get')) {
            $cat_list = array();
            $data = $this->Category->find('all', array('recursive' => 0, 'fields' => array('parent_id', 'is_special', 'title', 'image_extension', 'order'), 'conditions' => array('Category.status' => 'active'), 'order' => array('Category.order')));
            if ($data) {
                foreach ($data as $key => $value) {
                    $cat_list[] = $value['Category'];
                }
            }

            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => $cat_list),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }

    public function main_category_list()
    {
        if ($this->request->is('get')) {
            $data = $this->Category->find('threaded', array('recursive' => 1, 'fields' => array('id', 'title', 'image_extension'),
                'conditions' => array('Category.status' => 'active', 'Category.parent_id' => '', 'Category.is_featured' => 1),
                'order' => array('Category.order' => 'ASC')
            ));

            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => $data),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }


    public function main_special_category_list()
    {
        if ($this->request->is('get')) {
            $data = $this->Category->find('threaded', array('recursive' => 1, 'fields' => array('id', 'title', 'image_extension'),
                'conditions' => array('Category.status' => 'active', 'Category.parent_id' => '', 'Category.is_special' => 1)));

            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => $data),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceCategories' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }


    /**
     * get random product list
     */
    public function random_product_list()
    {
        $postData = $this->request->input('json_decode', true);
        if (isset($postData['pageNo'])) {
            $page = $postData['pageNo'];
        } else {
            $page = 1;
        }

        // limit
        if (isset($postData['limit']) and !empty($postData['limit'])) {
            $limit = $postData['limit'];
        } else {
            $limit = 20;
        }



        if (isset($postData['productOrderBy']) and !empty($postData['productOrderBy'])) {
            $productOrderBy = $postData['productOrderBy'];
        } else {
            $productOrderBy = 'asc';
        }


        if (isset($postData['productSortBy']) and !empty($postData['productSortBy'])) {
            $productSortBy = $postData['productSortBy'];
        } else {
            $productSortBy = 'created';
        }


        //productBrowseBy
        if (isset($postData['productBrowseBy']) and !empty($postData['productBrowseBy'])) {
            $productBrowseBy = $postData['productBrowseBy'];
        } else {
            $productBrowseBy = 'random';
        }


        if($productBrowseBy == 'free') {
            $data = $this->Product->find(
                'all',
                array(
                    'conditions' => array('status' => 'active','is_free ' => 1),
                    'order' => array($productSortBy => $productOrderBy),
                    'limit' => $limit,
                    'page' => $page
                )
            );
            $noOfProducts = $this->Product->find(
                'count',
                array(
                    'conditions' => array('status' => 'active','is_free ' => 1)
                )
            );

        }else if($productBrowseBy == 'paid') {
            $data = $this->Product->find(
                'all',
                array(
                    'conditions' => array('status' => 'active','is_free ' => 0),
                    'order' => array($productSortBy => $productOrderBy),
                    'limit' => $limit,
                    'page' => $page
                )
            );
            $noOfProducts = $this->Product->find(
                'count',
                array(
                    'conditions' => array('status' => 'active','is_free ' => 0)
                )
            );


        }else{
            $data = $this->Product->find(
                'all',
                array(
                    'conditions' => array('status' => 'active'),
                    'order' => array($productSortBy => $productOrderBy),
                    'limit' => $limit,
                    'page' => $page
                )
            );
            $noOfProducts = $this->Product->find('count');

        }

        $productList = array();
        foreach ($data as $key => $val) {
            $checkData = json_decode($val['Product']['options'], true);
            $val['Product']['options'] = $checkData;
            array_push($productList, $val);
        }


        $pageNo = $this->paginationCalculator($noOfProducts, $limit);
        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceProductList' => $productList, 'paginagtion' => $pageNo, 'noOfProducts' => $noOfProducts),
                '_jsonp' => true
            )
        );

        $this->render('json_render');
    }

    /*pagination*/
    private function paginationCalculator($count, $limit)
    {
        $extraPage = $count % $limit;
        $defaultPage = ($count - ($count % $limit)) / $limit;
        if ($extraPage > 0) {
            $noOfPage = $defaultPage + 1;
        } else {
            $noOfPage = $defaultPage;
        }

        $pages = array();
        for ($i = 1; $i <= $noOfPage; $i++) {
            $pages[$i] = $i;
        }

        sort($pages);

        return $pages;
    }


    public function favorite_product_list()
    {
        $data = array();

        if ($this->request->is('post')) {
            //catch post ata
            //$data =  $this->request->data;//input('json_decode',true);
            $productIds = $this->request->input('json_decode', true);

            $productIds = json_decode($productIds['productIds']);

            $data = $this->Product->find(
                'all',
                array(
                    'fields' => array('Product.title', 'Product.product_code'),
                    'contain' => array(
                        'ProductImage'
                    ),
                    'conditions' => array(
                        'Product.status' => 'active',
                        'Product.id' => $productIds
                    ),
                    'order' => array('modified' => 'asc')
                )
            );
        }


        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceProductList' => $data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    /**
     * product_list_by_category
     */
    public function product_list_by_category($id)
    {

        $productCondition = array(
            'Product.status' => 'active'
        );

        $postData = $this->request->input('json_decode', true);

        //productBrowseBy
        if (isset($postData['productBrowseBy']) and !empty($postData['productBrowseBy'])) {
            $productBrowseBy = $postData['productBrowseBy'];
            if($productBrowseBy == 'free') {
                $productCondition['Product.is_free'] = 1;
            }else if($productBrowseBy == 'paid') {
                $productCondition['Product.is_free'] = 0;
            }
        }



        $chilCatList = $data = $this->Category->find('list',
            array('recursive' => 0,
                'fields' => array('id', 'id'),
                'conditions' => array('Category.status' => 'active', 'Category.parent_id' => $id)
            ));
        $chilCatList[$id] = $id;

        $data = $this->Product->find(
            'all',
            array(
                'contain' => array(
                    'ProductCategory' => array(
                        'conditions' => array(
                            'ProductCategory.category_id' => $chilCatList,
                        ),
                        //'limit'=> '1200',
                    ),
                    'ProductImage'
                ),
                'conditions' => $productCondition,
                //'limit'=> $limit,
                'order' => 'Rand()',
            )
        );

        //productBrowseBy
        if (isset($postData['productBrowseBy']) and !empty($postData['productBrowseBy'])) {
            $productBrowseBy = $postData['productBrowseBy'];
        } else {
            $productBrowseBy = 'random';
        }


        if($productBrowseBy == 'free') {
            $data = $this->Product->find(
                'all',
                array(
                    'contain' => array(
                        'ProductCategory' => array(
                            'conditions' => array(
                                'ProductCategory.category_id' => $chilCatList,
                            ),
                            //'limit'=> '1200',
                        ),
                        'ProductImage'
                    ),
                    'conditions' => array(
                        'Product.status' => 'active',
                        'Product.is_free' => 1,
                    ),
                    //'limit'=> $limit,
                    'order' => 'Rand()',
                )
            );
        }else if($productBrowseBy == 'paid') {
            $data = $this->Product->find(
                'all',
                array(
                    'contain' => array(
                        'ProductCategory' => array(
                            'conditions' => array(
                                'ProductCategory.category_id' => $chilCatList,
                            ),
                            //'limit'=> '1200',
                        ),
                        'ProductImage'
                    ),
                    'conditions' => array(
                        'Product.status' => 'active',
                        'Product.is_free' => 0,
                    ),
                    //'limit'=> $limit,
                    'order' => 'Rand()',
                )
            );

        }else{
            $data = $this->Product->find(
                'all',
                array(
                    'contain' => array(
                        'ProductCategory' => array(
                            'conditions' => array(
                                'ProductCategory.category_id' => $chilCatList,
                            ),
                            //'limit'=> '1200',
                        ),
                        'ProductImage'
                    ),
                    'conditions' => array(
                        'Product.status' => 'active'
                    ),
                    //'limit'=> $limit,
                    'order' => 'Rand()',
                )
            );
        }

        //pr($chilCatList);

        //sort out by cat
        foreach ($data as $key => $val) {
            if (sizeof($val['ProductCategory']) <= 0) {
                unset($data[$key]);
            } else {
                $data[$key]['Product']['options'] = json_decode($data[$key]['Product']['options'], true);

            }
        }


        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceProductList' => $data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    /**
     * product_list_by_industry
     */
    public function product_list_by_industry($id)
    {
        $productCondition = array(
            'Product.status' => 'active',
            'Product.is_free' => 0
        );

        $postData = $this->request->input('json_decode', true);

        //productBrowseBy
        if (isset($postData['productBrowseBy']) and !empty($postData['productBrowseBy'])) {
            $productBrowseBy = $postData['productBrowseBy'];
            if($productBrowseBy == 'free') {
                $productCondition['Product.is_free'] = 1;
            }else if($productBrowseBy == 'paid') {
                $productCondition['Product.is_free'] = 0;
            }else if($productBrowseBy == 'random') {
                $productCondition['Product.is_free'] = 0;
            }
        }


        $data = $this->Product->find(
            'all',
            array(
                'contain' => array(
                    'ProductIndustry' => array(
                        'conditions' => array(
                            'ProductIndustry.industry_id' => $id
                        )
                    ),
                    'ProductImage'
                ),
                'conditions' => $productCondition,
                'order' => array('modified' => 'asc')
            )
        );

        //sort out by cat
        foreach ($data as $key => $val) {
            if (sizeof($val['ProductIndustry']) <= 0) {
                unset($data[$key]);
            } else {
                $data[$key]['Product']['options'] = json_decode($data[$key]['Product']['options'], true);
            }
        }
        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceProductList' => $data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }


    /**
     * product_list_by_brand
     */
    public function product_list_by_brand($id)
    {
        $data = $this->Product->find(
            'all',
            array(
                'contain' => array(
                    'ProductBrand' => array(
                        'conditions' => array(
                            'ProductBrand.brand_id' => $id
                        )
                    ),
                    'ProductImage'
                ),
                'conditions' => array(
                    'Product.status' => 'active',
                ),
                'order' => array('modified' => 'asc')
            )
        );

        //sort out by cat
        foreach ($data as $key => $val) {
            if (sizeof($val['ProductBrand']) <= 0) {
                unset($data[$key]);
            } else {
                $data[$key]['Product']['options'] = json_decode($data[$key]['Product']['options'], true);
            }
        }
        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceProductList' => $data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    /**
     * product_details_by_id
     */
    public function product_details()
    {
        if ($this->request->is('post')) {
            $postData = $this->request->input('json_decode', true);
            $data = $this->Product->find(
                'all',
                array(
                    'contain' => array(
                        'ProductBrand',
                        'ProductCategory',
                        'ProductImage',
                        'ProductAttribute' => array(
                            'ProductAttributeValue'
                        ),
                        'RelatedProduct'
                    ),
                    'conditions' => array(
                        'Product.id' => $postData['productId'],
                        'Product.status' => 'active',
                    )
                )
            );
            $data[0]['Product']['options'] = json_decode($data[0]['Product']['options'], true);
			//stock calculation
			$stock = $this->Stock->find(
					'all',
					array(
						'recursive'=>-1,
						'fields'=>array('SUM(quantity) as stockTotal'),
						'conditions'=>array('product_id'=>$postData['productId'])
					)
				);
			$sale = $this->Sale->find(
				'all',
				array(
					'recursive'=>-1,
					'fields'=>array('SUM(quantity) as saleTotal'),
					'conditions'=>array('product_id'=>$postData['productId'])
				)
			);
			$data[0]['availableInStock'] = ($stock[0][0]['stockTotal'] - $sale[0][0]['saleTotal']);
            $relatedProducts = $this->Product->find(
                'all',
                array(
                    'fields' => array(
                        'id', 'title', 'product_code', 'price'
                    ),
                    'contain' => 'ProductImage'
                )
            );


            $relatedProductsList = array();
            foreach ($data[0]['RelatedProduct'] as $k => $v) {
                $realtedProductId = $v['related_product'];
                foreach ($relatedProducts as $r_k => $r_v) {
                    if ($r_v['Product']['id'] == $realtedProductId) {
                        array_push($relatedProductsList, $r_v);
                    }
                }
            }
            $data[0]['RelatedProduct'] = $relatedProductsList;

            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceProductDetails' => $data),
                    '_jsonp' => true
                )
            );
        }
        //$postData = $this->request->data;


        $this->render('json_render');
    }

    /**
     * product_attribute_list
     */
    public function product_attribute_list()
    {
        if ($this->request->is('post')) {
            $postData = $this->request->input('json_decode', true);
            //$postData = $this->request->data;
            $data = $this->Attribute->find('all', array('conditions' => array('Attribute.type_id' => $postData['type_id'])));
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceProductAttributes' => $data),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }


    // success method

    function paymentsuccess()
    {
        $post_data = $_POST;
        if (!empty($post_data)) {
            $orderId = substr($post_data['tran_id'], 6);


            $productOrderData = $this->ProductOrder->find('first',
                array(
                    'recursive' => -1,
                    'conditions' => array('ProductOrder.id' => $orderId)
                ));


            if ($productOrderData) {
                $productOrderDetails = json_decode($productOrderData['ProductOrder']['order_detail'], true);
                $clientDetails = json_decode($productOrderData['ProductOrder']['client_detail'], true);
                $clientDetails = json_decode($clientDetails['Client']['details'], true);

                $productkeies = array();
                $productkeiessell = array();
                $productkeiessellarray = array();

                if (is_array($productOrderDetails)) {
                    foreach ($productOrderDetails as $key => $val) {
                        $product_id = $val['product_id'];
                        $productKeyAttributesData = $val['productKeyAttributesData'];
                        $product_title = $val['product_title'];
                        $quantity = $val['quantity'];

                        $productkeies = $this->ProductKeie->find('list',
                            array(
                                'recursive' => -1,
                                'fields' => array('ProductKeie.key'),
                                'conditions' => array(
                                    'ProductKeie.product_id' => $product_id,
                                    'ProductKeie.attribute_id' => $productKeyAttributesData['attribute_id'],
                                    'ProductKeie.attribute_value_id' => $productKeyAttributesData['attribute_value_id'],
                                    'ProductKeie.status' => 0
                                ),
                                'limit' => $quantity
                            )
                        );

                        if (sizeof($productkeies) == $quantity) {

                            $newKeyIndex = $product_id . '~' . $productKeyAttributesData['attribute_id'] . '~' . $productKeyAttributesData['attribute_value_id'];

                            $productkeiessell[$newKeyIndex] = $productkeies;
                            $productkeiessellarray = array_merge($productkeiessellarray, array_keys($productkeies));
                        }
                    }
                }

                $data['ProductOrder']['payment_status'] = 'OK';
                $data['ProductOrder']['status'] = 'completed';
                $data['ProductOrder']['payment_detail'] = json_encode($post_data);
                if (is_array($productkeiessell) and !empty($productkeiessell)) {
                    $data['ProductOrder']['product_keys'] = json_encode($productkeiessell);
                }

                $this->ProductOrder->id = $orderId;
                if ($this->ProductOrder->save($data)) {
                    /**** update key status for sell  ****/

                    if (is_array($productkeiessellarray) and !empty($productkeiessellarray)) {
                        $this->ProductKeie->updateAll(
                            array('ProductKeie.status' => 1),
                            array('ProductKeie.id' => ($productkeiessellarray))
                        );
                    }

                    $this->sendCustomerOrderMail($orderId);

                    $this->redirect("http://checknpick.com/#/shop/order/" . $orderId . "/success");
                };

            }

        } else {
            $this->redirect("http://checknpick.com");
        }
    }

    // fail or cancel method


    function sendCustomerOrderMail($id, $from = false)
    {
        $this->autoRender = false;

        if ($id) {


            if (!$this->ProductOrder->exists($id)) {
                throw new NotFoundException(__('Invalid product order'));
            }
            $options = array('conditions' => array('ProductOrder.' . $this->ProductOrder->primaryKey => $id));
            $response = $this->ProductOrder->find('first', $options);


            $order_code = ($response['ProductOrder']['order_code']);
            $order_detail = json_decode($response['ProductOrder']['order_detail']);

            $product_keys = json_decode($response['ProductOrder']['product_keys']);

            $client = json_decode($response['ProductOrder']['client_detail']);
            $clientDetails = json_decode($client->Client->details);


            $emailConfig = array();
            $emailConfig['from_name'] = 'CheckNPick Admin.';
            $emailConfig['from_email'] = 'info@checknpick.com';


            $emailConfig['to'] = $clientDetails->username;
            $emailConfig['subject'] = 'Invoice Payment Confirmation for Order Code: ' . $order_code;

            $emailConfig['clientDetails'] = $clientDetails;
            $emailConfig['orderdetails'] = $order_detail;
            $emailConfig['order'] = $response;
            $emailConfig['product_keys'] = (array)$product_keys;

            $emailConfig['data'] = $emailConfig;


            $emailConfig['template'] = 'orderwithkey';
            $isSend = $this->EmailSender->sendEmail($emailConfig);


            $emailConfig['to'] = 'sales@checknpick.com';
            $emailConfig['subject'] = 'New Order (' . $order_code . ') from checknpick.com';
            $emailConfig['template'] = 'adminorder';
            $isSend = $this->EmailSender->sendEmail($emailConfig);


            if ($isSend) {
                $this->Session->setFlash('Mail has been sent.', 'default', array('class' => 'alert alert-success'));
                if ($from) {
                    $this->redirect($this->referer());
                }
                return true;
            } else {
                if ($from) {
                    $this->redirect($this->referer());
                }
                return false;
            }

        }
    }

    // success method

    function paymentfailure()
    {
        $post_data = $_POST;
        if (!empty($post_data)) {
            $orderId = substr($post_data['tran_id'], 6);
            $this->ProductOrder->id = $orderId;
            $this->ProductOrder->delete();

            $this->redirect("http://checknpick.com/#/shop/order/" . $orderId . "/failure");
        } else {
            $this->redirect("http://checknpick.com");
        }

    }

    /**
     * checkout
     */
    public function order()
    {
        if ($this->request->is('post')) {
            //$post_data =  $this->request->data;
            $post_data = $this->request->input('json_decode', true);
           
           
            $outOfStockProducts = $this->checkAvailableProductInstock($post_data);
             
            if(sizeof($outOfStockProducts['availableInStock']) < 1){
            	$paymentType = $post_data['shipping_detail']['paymentMethod'];
            	
            	
            	$ready_data['ProductOrder']['client_detail'] = json_encode($post_data['client_details']);
            	$ready_data['ProductOrder']['order_detail'] = json_encode($post_data['cart']);
            	$ready_data['ProductOrder']['shipping_detail'] = json_encode($post_data['shipping_detail']);
            	$ready_data['ProductOrder']['shipping_cost'] = 0;
            	$ready_data['ProductOrder']['status'] = 'ordered';
            	$ready_data['ProductOrder']['order_code'] = date('ymdhms');
            	
            	if ($this->ProductOrder->save($ready_data)) {
            		$saleDataArray = array();
            		$i = 0;
            		foreach ($outOfStockProducts['orderProductQuantity'] as $key => $value){
            			$saleDataArray[$i]['Sale']['product_id'] = $key;
            			$saleDataArray[$i]['Sale']['quantity'] = $value;
            			$i++;
            		}
            		$this->Sale->saveAll($saleDataArray);
            		
            		$order_id = $this->ProductOrder->getInsertId();
            		$response['status'] = true;
            		$response['orderId'] = $order_id;
            		$response['totalCost'] = $post_data['total_cost'];
            		$response['message'] = 'Order Success.';
            		$response['stockStatus'] = false;
            	
            		if ($paymentType == 'cod') {
            			$this->sendCustomerOrderMail($order_id);
            		}
            	
            	} else {
            		$response['status'] = false;
            		$response['message'] = 'Please try again';
            	}
            }else{
            	$response['status'] = true;
            	$response['stockStatus'] = true;
            	$response['message'] = $outOfStockProducts['availableInStock'];
            }
            //paymentDetail

        } else {
            $response = array('message' => 'Invalid Request');
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceCheckout' => $response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');

    }
    // check available product in stock
    
    private function checkAvailableProductInstock($data){
    	$orderProductQuantity = array();
    	$orderProductIds = array();
    	$orderProductTitles = array();
    	foreach($data['cart'] as $datum){
    		if(in_array($datum['product_id'],$orderProductIds)){
    			$orderProductQuantity[$datum['product_id']] = ($orderProductQuantity[$datum['product_id']] + $datum['quantity']);
    		}else{
    			$orderProductQuantity[$datum['product_id']] = $datum['quantity'];
    			$orderProductIds[] = $datum['product_id'];
    			$orderProductTitles[$datum['product_id']] = $datum['product_title'];
    		}
    		 
    	}
     	$orderProductInStockQuantity = $this->Stock->find(
				'all',
				array(
					'recursive'=>-1,
					'fields'=>array('product_id','SUM(quantity) as stockTotal'),
					 'conditions'=>array('product_id'=>$orderProductIds),
					'group'=>'product_id'
				)
			);
     	$stockData = array();
     	foreach($orderProductInStockQuantity as $stockQuantity){
     		$stockData[$stockQuantity['Stock']['product_id']] = $stockQuantity[0]['stockTotal'];
     	}
     	$orderProductSaleQuantity = $this->Sale->find(
     		'all',
     		array(
     			'recursive'=>-1,
     			'fields'=>array('product_id','SUM(quantity) as stockTotal'),
     			'conditions'=>array('product_id'=>$orderProductIds),
     			'group'=>'product_id'
     		)
     	);
     	$availableInStock = array();
     	$nowAvailableQuantity = '';
     	foreach($orderProductSaleQuantity as $sale){
     		$inSock = $stockData[$sale['Sale']['product_id']];
     		$nowAvailableQuantity = ($inSock - $sale[0]['stockTotal']);
     		$orderQty = $orderProductQuantity[$sale['Sale']['product_id']];
     		if($orderQty > $nowAvailableQuantity){
     			$availableInStock[$orderProductTitles[$sale['Sale']['product_id']]] =  $nowAvailableQuantity;
     		}
     	}
     $stockIno['availableInStock'] = $availableInStock;
     $stockIno['orderProductQuantity'] = $orderProductQuantity;
     	 
    return $stockIno;
    	 
    }
    /*
     * shoping history
    */

    public function shoping_history()
    {

        if ($this->request->is('post')) {
            //$post_data =  $this->request->data;//$this->request->input('json_decode',true);
            $post_data = $this->request->input('json_decode', true);

            $client_data = json_decode($post_data['client_details'], true);

            $client_id = $client_data['Client']['id'];

            //ordered
            $data_ordered = $this->ProductOrder->find(
                'all',
                array(
                    'conditions' => array(
//                        'ProductOrder.payment_status' => 'OK',
                        'client_detail LIKE' => "%$client_id%",
                        'status' => 'ordered'
                    ),
                    'order' => array('order_date' => 'DESC'),
                    'recursive' => -1
                )
            );

            //processing
            $data_processing = $this->ProductOrder->find(
                'all',
                array(
                    'conditions' => array(
//                        'ProductOrder.payment_status' => 'OK',
                        'client_detail LIKE' => "%$client_id%",
                        'status' => 'processing'
                    ),
                    'order' => array('order_date' => 'DESC'),
                    'recursive' => -1
                )
            );

            //completed
            $data_completed = $this->ProductOrder->find(
                'all',
                array(
                    'conditions' => array(
//                        'ProductOrder.payment_status' => 'OK',
                        'client_detail LIKE' => "%$client_id%",
                        'status' => 'completed'
                    ),
                    'order' => array('order_date' => 'DESC'),
                    'recursive' => -1
                )
            );

            $data_cancelled = $this->ProductOrder->find(
                'all',
                array(
                    'conditions' => array(
//                        'ProductOrder.payment_status' => 'OK',
                        'client_detail LIKE' => "%$client_id%",
                        'status' => 'cancelled'
                    ),
                    'order' => array('order_date' => 'DESC'),
                    'recursive' => -1
                )
            );

            $response['ordered'] = $data_ordered;
            $response['processing'] = $data_processing;
            $response['completed'] = $data_completed;
            $response['cancelled'] = $data_cancelled;


        } else {
            $response = array('message' => 'Invalid Request');
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceHistory' => $response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }


    public function payNow()
    {
        $response = $this->Icepay->payByIcePay();
        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceHistory' => $response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    public function payment_methods()
    {
        $payment_methods = $this->Icepay->getPaymentMethods();

        $payment_methods_data = array();
        foreach ($payment_methods as $k => $v) {
            $payment_methods_data[$v['PaymentMethodCode']] = $v['Description'];
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('ecommercePaymentMethods' => $payment_methods_data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    /*
     public function brandTree(){
    if($this->request->is('get')){
    $data = $this->Brand->find('all',array('conditions'=>array('status'=>'active')));
    $this->set(
            array(
                    '_serialize',
                    'data' => array('ecommerceBrands'=>$data),
                    '_jsonp' => true

            )
    );
    }else{
    $this->set(
            array(
                    '_serialize',
                    'data' => array('ecommerceBrands'=>'Invalid Request'),
                    '_jsonp' => true
            )
    );
    }
    $this->render('json_render');
    }

    */

    public function getStores()
    {
        if ($this->request->is('get')) {
            $data = $this->Store->find('all', array('conditions' => array('status' => 'active'), 'order' => array('order' => 'asc')));
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceStores' => $data),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceStores' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }
        $this->render('json_render');
    }

    public function getAttrByCatId()
    {
        if ($this->request->is('post')) {
            //$postData = $this->request->data;
            $postData = $this->request->input('json_decode', true);


            $typeId = $this->TypeCategory->find('first',
                array(
                    'conditions' => array(
                        'category_id' => $postData['catId']
                    ),
                    'fields' => array('TypeCategory.type_id', 'Category.title'),
                    'recursive' => 1
                )
            );


            //get all attributes by type
            if (isset($typeId['TypeCategory']['type_id'])) {
                $attList = $this->Attribute->find(
                    'all',
                    array(
                        'contain' => array(
                            'AttributeValue' => array(
                                'fields' => array(
                                    'value',
                                    'id'
                                )
                            )
                        ),
                        'conditions' => array(
                            'Attribute.type_id' => $typeId['TypeCategory']['type_id']
                        ),
                        'fields' => array('title')
                    )
                );
            } else {
                $attList = '';
            }

            $response['catTitle'] = false;

            if ($typeId['Category'] != 'undefined') {
                $response['catTitle'] = $typeId['Category']['title'];
            };

            $response['status'] = true;
            $response['message'] = $attList;
        } else {
            $response['status'] = false;
            $response['message'] = 'Invalid request type.';
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('attributesForFilter' => $response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    public function getProductsByAttrFilter()
    {

        //$postData = $this->request->data;
        $postData = $this->request->input('json_decode', true);
        $request_attr_id = '';
        $request_attr_val_id = '';
        //attr filtes
        foreach (($postData['filterRulesQuery']) as $key => $value) {
            $request_attr_id .= "ProductAttribute.attribute_id = '{$key}' OR ";

            foreach ($value as $k => $v) {

                $request_attr_val_id .= "ProductAttributeValue.attribute_value_id = '{$v}' OR ";
            }
        }


        $data = $this->Product->find(
            'all',
            array(
                'contain' => array(
                    //'ProductBrand',
                    'ProductCategory' => array(
                        'conditions' => array(
                            'ProductCategory.category_id' => $postData['catId']
                        )
                    ),
                    'ProductImage',
                    'ProductAttribute' => array(
                        'conditions' => array(
                            substr($request_attr_id, 0, -4)
                        ),
                        'ProductAttributeValue' => array(
                            'conditions' => array(
                                substr($request_attr_val_id, 0, -4)
                            )
                        )
                    )
                ),
                'conditions' => array('status' => 'active'),
                'order' => array('created' => 'asc'),
                'limit' => 20
            )
        );

        //filter
        foreach ($data as $key => $value) {
            $data[$key]['Product']['options'] = json_decode($data[$key]['Product']['options'], true);
            if (sizeOf($value['ProductAttribute']) <= 0) {
                unset($data[$key]);
            } else {
                $attrValValStatus = 0;
                foreach ($value['ProductAttribute'] as $attr_k => $attr_v) {
                    if (sizeof($attr_v['ProductAttributeValue']) > 0) {
                        $attrValValStatus++;
                    }
                }

                if ($attrValValStatus == 0) {
                    unset($data[$key]);
                }
            }

            if (isset($data[$key])) {
                unset($data[$key]['ProductAttribute']);
            }
        }

        $this->set(
            array(
                '_serialize',
                'data' => array('ecommerceProductList' => $data),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    public function order_update_by_icepay()
    {
        if ($this->request->is('POST')) {
            //$data = $this->request->data;
            $data = $this->request->input('json_decode', true);
            $saveData['ProductOrder']['payment_detail'] = json_encode($data['paymentDetails']);
            $saveData['ProductOrder']['payment_status'] = $data['paymentStatus'];
            $this->ProductOrder->id = $data['orderId'];

            /*
            if ($this->ProductOrder->save($saveData)) {
                $response['status'] = true;
                $data = $this->ProductOrder->find(
                    'first',
                    array(
                        'conditions' => array('id' => $data['orderId'])
                    )
                );
                $responseData['orderId'] = $data['ProductOrder']['id'];
                $responseData['billingDetails'] = json_decode(json_decode($data['ProductOrder']['client_detail'], true));
                $responseData['shippingDetails'] = json_decode($data['ProductOrder']['shipping_detail'], true);
                $responseData['orderDetails'] = json_decode($data['ProductOrder']['order_detail'], true);
                //$responseData['orderStatus'] =  json_decode($data['ProductOrder']['order_detail'],true);
                $response['message'] = $responseData;
            } else {
                $response['status'] = true;
                $response['message'] = 'Something wrong';
            }
            */

        } else {
            $response['status'] = false;
            $response['message'] = 'Invalid Request';
        }


        //sent to site
        $this->set(
            array(
                '_serialize',
                'data' => array('orderPaymentStatus' => $response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');
    }

    public function order_view($id = null)
    {
        $this->layout = false;
        $this->autoRender = false;

        if (!$this->ProductOrder->exists($id)) {
            throw new NotFoundException(__('Invalid product order'));
        }
        $options = array('conditions' => array('ProductOrder.status' => 'completed', 'ProductOrder.' . $this->ProductOrder->primaryKey => $id));
        $response = $this->ProductOrder->find('first', $options);


        $order_detail = json_decode($response['ProductOrder']['order_detail']);
        $productDataArray = array();
        if (is_array($order_detail)) {
            foreach ($order_detail as $product) {
                $product_id = $product->product_id;
                $productOptions = array('fields' => array('Product.download_link'), 'contain' => array('ProductImage' => array('fields' => array('ProductImage.extension'), 'conditions' => array('ProductImage.extension' => 'zip'))), 'conditions' => array('Product.id' => $product_id));
                $productData = $this->Product->find('first', $productOptions);
                $productDataArray[$product_id] = $productData;
            }
        }
        $response['productData'] = $productDataArray;


        $this->set(
            array(
                '_serialize',
                'data' => array('orderData' => $response),
                '_jsonp' => true
            )
        );
        $this->render('json_render');

        //$this->set('merchants',$this->getMerchants());
    }

    public function category_tree()
    {
        $this->layout = false;
        $this->autoRender = false;
        $data = $this->Category->find(
            'threaded',
            array(
                'contain' => array(),
                'conditions' => array(
                    'status' => 'active'
                ),
                //'order' => 'order'
            )
        );
        //array_ma
        $listString = $this->TreeList($data);
        $listArray = explode('#id#', $listString);
        $catTreeList = array();
        for ($i = 1; $i < sizeof($listArray); $i++) {
            $listIndData = explode('#title#', $listArray[$i]);
            $catTreeList[$i]['id'] = $listIndData[0];
            $catTreeList[$i]['title'] = $listIndData[1];
        }


        $this->set(
            array(
                '_serialize',
                'data' => array('categoryTree' => $catTreeList),
                '_jsonp' => true
            )
        );


        $this->render('json_render');

    }


    function TreeList($threaded, $level = 0, &$html = '')
    {
        if (sizeof($threaded) > 0) {
            foreach ($threaded as $key => $node) {
                foreach ($node as $type => $threaded) {
                    if ($type !== 'children') {
                        $dash_html = '';
                        for ($i = 1; $i <= $level; $i++) {
                            $dash_html .= '-';
                        }
                        $html .= "#id#" . $threaded['id'] . "#title#" . $dash_html . " " . $threaded['title'];
                    } else {
                        if (!empty($threaded)) {
                            $html .= $this->TreeList($threaded, $level + 1);
                        }
                    }
                }
            }
        }
        return $html;
    }


    //random deal list

    public function random_deal_list()
    {
        if ($this->request->is('Post')) {
            //$postData = $this->request->data;
            $postData = $this->request->input('json_decode', true);
            if (isset($postData['pageNo'])) {
                $page = $postData['pageNo'];
            } else {
                $page = 1;
            }
            $limit = 20;

            $data = $this->Product->find(
                'all',
                array(
                    'conditions' => array('status' => 'active'),
                    'order' => array('created' => 'asc'),

                    'page' => $page
                )
            );

            $productList = array();
            foreach ($data as $key => $val) {
                if (sizeof($productList) > $limit) {
                    break;
                }
                $checkData = json_decode($val['Product']['options'], true);
                if ($checkData['discount'][1]['amount'] > 0) {
                    $val['Product']['options'] = $checkData;
                    array_push($productList, $val);
                }
            }
            //$noOfProducts = $this->Product->find('count');
            $pageNo = $this->paginationCalculator(sizeof($productList), $limit);
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceProductList' => $productList, 'paginagtion' => $pageNo),
                    '_jsonp' => true
                )
            );
        } else {
            $this->set(
                array(
                    '_serialize',
                    'data' => array('ecommerceProductList' => 'Invalid Request'),
                    '_jsonp' => true
                )
            );
        }

        $this->render('json_render');
    }


    //video downloader
    public function download($filePath)
    {

        $filePath = base64_decode($filePath);

        //pr($filePath);
        $file = WWW_ROOT . $filePath;
        pr($file);
        die();
        $this->response->file($file, array(
            'download' => true,
            'name' => $file,
        ));
        return $this->response;
    }
    
     public function beforeRender()
    {
        parent::beforeRender();
        $this->response->header('Access-Control-Allow-Origin', '*');
    }
    
}