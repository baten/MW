<?php
App::uses('ProductStock', 'Ecommerce.Model');

/**
 * ProductStock Test Case
 *
 */
class ProductStockTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_stock',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductStock = ClassRegistry::init('Ecommerce.ProductStock');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductStock);

		parent::tearDown();
	}

}
