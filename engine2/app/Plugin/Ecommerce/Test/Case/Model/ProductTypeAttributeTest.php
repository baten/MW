<?php
App::uses('ProductTypeAttribute', 'Ecommerce.Model');

/**
 * ProductTypeAttribute Test Case
 *
 */
class ProductTypeAttributeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_type_attribute',
		'plugin.ecommerce.product_type',
		'plugin.ecommerce.product_type_attribute_value'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductTypeAttribute = ClassRegistry::init('Ecommerce.ProductTypeAttribute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductTypeAttribute);

		parent::tearDown();
	}

}
