<?php
App::uses('Product', 'Ecommerce.Model');

/**
 * Product Test Case
 *
 */
class ProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product',
		'plugin.ecommerce.product_attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Product = ClassRegistry::init('Ecommerce.Product');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Product);

		parent::tearDown();
	}

}
