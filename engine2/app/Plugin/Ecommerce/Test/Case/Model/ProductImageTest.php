<?php
App::uses('ProductImage', 'Ecommerce.Model');

/**
 * ProductImage Test Case
 *
 */
class ProductImageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_image',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductImage = ClassRegistry::init('Ecommerce.ProductImage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductImage);

		parent::tearDown();
	}

}
