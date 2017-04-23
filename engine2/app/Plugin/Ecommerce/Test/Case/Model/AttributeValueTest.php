<?php
App::uses('AttributeValue', 'Ecommerce.Model');

/**
 * AttributeValue Test Case
 *
 */
class AttributeValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.attribute_value',
		'plugin.ecommerce.attribute',
		'plugin.ecommerce.product_attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AttributeValue = ClassRegistry::init('Ecommerce.AttributeValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AttributeValue);

		parent::tearDown();
	}

}
