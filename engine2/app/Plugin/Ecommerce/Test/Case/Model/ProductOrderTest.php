<?php
App::uses('ProductOrder', 'Ecommerce.Model');

/**
 * ProductOrder Test Case
 *
 */
class ProductOrderTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_order',
		'plugin.ecommerce.product_order_note'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductOrder = ClassRegistry::init('Ecommerce.ProductOrder');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductOrder);

		parent::tearDown();
	}

}
