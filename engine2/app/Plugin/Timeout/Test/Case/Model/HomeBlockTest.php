<?php
App::uses('HomeBlock', 'Timeout.Model');

/**
 * HomeBlock Test Case
 *
 */
class HomeBlockTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.timeout.home_block'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HomeBlock = ClassRegistry::init('Timeout.HomeBlock');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HomeBlock);

		parent::tearDown();
	}

}
