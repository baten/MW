<?php
App::uses('SocialNetwork', 'Model');

/**
 * SocialNetwork Test Case
 *
 */
class SocialNetworkTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.social_network'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SocialNetwork = ClassRegistry::init('SocialNetwork');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SocialNetwork);

		parent::tearDown();
	}

}
