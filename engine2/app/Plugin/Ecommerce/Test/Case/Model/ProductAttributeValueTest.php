<?php
App::uses('ProductAttributeValue', 'Ecommerce.Model');

/**
 * ProductAttributeValue Test Case
 *
 */
class ProductAttributeValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_attribute_value',
		'plugin.ecommerce.product_attribute',
		'plugin.ecommerce.attribute_value'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductAttributeValue = ClassRegistry::init('Ecommerce.ProductAttributeValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductAttributeValue);

		parent::tearDown();
	}

}
