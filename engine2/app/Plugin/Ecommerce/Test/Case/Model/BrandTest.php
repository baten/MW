<?php
App::uses('Brand', 'Ecommerce.Model');

/**
 * Brand Test Case
 *
 */
class BrandTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.brand'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Brand = ClassRegistry::init('Ecommerce.Brand');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Brand);

		parent::tearDown();
	}

}
