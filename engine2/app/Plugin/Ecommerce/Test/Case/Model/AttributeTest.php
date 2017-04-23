<?php
App::uses('Attribute', 'Ecommerce.Model');

/**
 * Attribute Test Case
 *
 */
class AttributeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.attribute',
		'plugin.ecommerce.type',
		'plugin.ecommerce.attribute_value'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Attribute = ClassRegistry::init('Ecommerce.Attribute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Attribute);

		parent::tearDown();
	}

}
