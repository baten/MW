<?php
App::uses('ProductKey', 'Ecommerce.Model');

/**
 * ProductKey Test Case
 *
 */
class ProductKeyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_key',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductKey = ClassRegistry::init('Ecommerce.ProductKey');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductKey);

		parent::tearDown();
	}

}
