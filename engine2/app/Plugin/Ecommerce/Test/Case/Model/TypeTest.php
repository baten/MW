<?php
App::uses('Type', 'Ecommerce.Model');

/**
 * Type Test Case
 *
 */
class TypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.type',
		'plugin.ecommerce.attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Type = ClassRegistry::init('Ecommerce.Type');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Type);

		parent::tearDown();
	}

}
