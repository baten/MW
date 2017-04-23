<?php
App::uses('ProductTypeAttributeValue', 'Ecommerce.Model');

/**
 * ProductTypeAttributeValue Test Case
 *
 */
class ProductTypeAttributeValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_type_attribute_value',
		'plugin.ecommerce.product_type_attribute',
		'plugin.ecommerce.product_attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductTypeAttributeValue = ClassRegistry::init('Ecommerce.ProductTypeAttributeValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductTypeAttributeValue);

		parent::tearDown();
	}

}
