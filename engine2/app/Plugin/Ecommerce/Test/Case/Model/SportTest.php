<?php
App::uses('Sport', 'Ecommerce.Model');

/**
 * Sport Test Case
 *
 */
class SportTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.sport'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sport = ClassRegistry::init('Ecommerce.Sport');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sport);

		parent::tearDown();
	}

}
