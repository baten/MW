<?php
App::uses('City', 'Shipping.Model');

/**
 * City Test Case
 *
 */
class CityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.shipping.city',
		'plugin.shipping.country'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->City = ClassRegistry::init('Shipping.City');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->City);

		parent::tearDown();
	}

}
