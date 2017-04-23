<?php
App::uses('ProductBrand', 'Ecommerce.Model');

/**
 * ProductBrand Test Case
 *
 */
class ProductBrandTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_brand',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductBrand = ClassRegistry::init('Ecommerce.ProductBrand');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductBrand);

		parent::tearDown();
	}

}
