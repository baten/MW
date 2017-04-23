<?php
App::uses('ProductType', 'Ecommerce.Model');

/**
 * ProductType Test Case
 *
 */
class ProductTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_type',
		'plugin.ecommerce.product_type_attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductType = ClassRegistry::init('Ecommerce.ProductType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductType);

		parent::tearDown();
	}

}
