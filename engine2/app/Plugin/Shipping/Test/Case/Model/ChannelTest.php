<?php
App::uses('Channel', 'Shipping.Model');

/**
 * Channel Test Case
 *
 */
class ChannelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.shipping.channel',
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
		$this->Channel = ClassRegistry::init('Shipping.Channel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Channel);

		parent::tearDown();
	}

}
