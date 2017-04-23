<?php
App::uses('Store', 'Ecommerce.Model');

/**
 * Store Test Case
 *
 */
class StoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.store'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Store = ClassRegistry::init('Ecommerce.Store');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Store);

		parent::tearDown();
	}

}
