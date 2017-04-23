<?php
App::uses('Client', 'Timeout.Model');

/**
 * Client Test Case
 *
 */
class ClientTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.timeout.client'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Client = ClassRegistry::init('Timeout.Client');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Client);

		parent::tearDown();
	}

}
