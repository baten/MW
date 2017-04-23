<?php
App::uses('ProductMerchant', 'Ecommerce.Model');

/**
 * ProductMerchant Test Case
 *
 */
class ProductMerchantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_merchant',
		'plugin.ecommerce.product',
		'plugin.ecommerce.merchant'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductMerchant = ClassRegistry::init('Ecommerce.ProductMerchant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductMerchant);

		parent::tearDown();
	}

}
