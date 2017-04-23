<?php
App::uses('Country', 'Shipping.Model');

/**
 * Country Test Case
 *
 */
class CountryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.shipping.country',
		'plugin.shipping.city'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Country = ClassRegistry::init('Shipping.Country');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Country);

		parent::tearDown();
	}

}
