<?php
App::uses('RelatedProduct', 'Ecommerce.Model');

/**
 * RelatedProduct Test Case
 *
 */
class RelatedProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.related_product',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RelatedProduct = ClassRegistry::init('Ecommerce.RelatedProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RelatedProduct);

		parent::tearDown();
	}

}
