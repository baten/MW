<?php
App::uses('Overview', 'Model');

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
		'app.overview'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Overview = ClassRegistry::init('Overview');
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
