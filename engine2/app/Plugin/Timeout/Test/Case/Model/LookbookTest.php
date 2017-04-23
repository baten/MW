<?php
App::uses('Lookbook', 'Timeout.Model');

/**
 * Lookbook Test Case
 *
 */
class LookbookTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.timeout.lookbook'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lookbook = ClassRegistry::init('Timeout.Lookbook');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lookbook);

		parent::tearDown();
	}

}
