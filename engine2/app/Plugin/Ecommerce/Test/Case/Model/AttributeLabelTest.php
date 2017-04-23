<?php
App::uses('AttributeLabel', 'Ecommerce.Model');

/**
 * AttributeLabel Test Case
 *
 */
class AttributeLabelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.attribute_label',
		'plugin.ecommerce.attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AttributeLabel = ClassRegistry::init('Ecommerce.AttributeLabel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AttributeLabel);

		parent::tearDown();
	}

}
