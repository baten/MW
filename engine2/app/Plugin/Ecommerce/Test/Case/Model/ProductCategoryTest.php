<?php
App::uses('ProductCategory', 'Ecommerce.Model');

/**
 * ProductCategory Test Case
 *
 */
class ProductCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_category',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductCategory = ClassRegistry::init('Ecommerce.ProductCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductCategory);

		parent::tearDown();
	}

}
