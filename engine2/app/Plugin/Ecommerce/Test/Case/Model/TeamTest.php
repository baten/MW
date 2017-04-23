<?php
App::uses('Team', 'Ecommerce.Model');

/**
 * Team Test Case
 *
 */
class TeamTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.team',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Team = ClassRegistry::init('Ecommerce.Team');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Team);

		parent::tearDown();
	}

}
