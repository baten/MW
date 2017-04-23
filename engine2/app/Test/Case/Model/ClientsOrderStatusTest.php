<?php
App::uses('ClientsOrderStatus', 'Model');

/**
 * ClientsOrderStatus Test Case
 *
 */
class ClientsOrderStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.clients_order_status',
		'app.client'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientsOrderStatus = ClassRegistry::init('ClientsOrderStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientsOrderStatus);

		parent::tearDown();
	}

}
