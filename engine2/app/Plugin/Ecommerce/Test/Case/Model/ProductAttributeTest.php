<?php
App::uses('ProductAttribute', 'Ecommerce.Model');

/**
 * ProductAttribute Test Case
 *
 */
class ProductAttributeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_attribute',
		'plugin.ecommerce.product',
		'plugin.ecommerce.attribute_value'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductAttribute = ClassRegistry::init('Ecommerce.ProductAttribute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductAttribute);

		parent::tearDown();
	}

}
