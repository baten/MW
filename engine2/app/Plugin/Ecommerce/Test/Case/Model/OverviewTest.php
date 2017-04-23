<?php
App::uses('Overview', 'Ecommerce.Model');

/**
 * Overview Test Case
 *
 */
class OverviewTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.overview'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Overview = ClassRegistry::init('Ecommerce.Overview');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Overview);

		parent::tearDown();
	}

}
