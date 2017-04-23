<?php
App::uses('ProductSport', 'Ecommerce.Model');

/**
 * ProductSport Test Case
 *
 */
class ProductSportTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_sport',
		'plugin.ecommerce.product',
		'plugin.ecommerce.sport'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSport = ClassRegistry::init('Ecommerce.ProductSport');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSport);

		parent::tearDown();
	}

}
