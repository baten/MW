<?php
App::uses('Merchant', 'Ecommerce.Model');

/**
 * Merchant Test Case
 *
 */
class MerchantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.merchant',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Merchant = ClassRegistry::init('Ecommerce.Merchant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Merchant);

		parent::tearDown();
	}

}
