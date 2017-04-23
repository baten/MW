<?php
App::uses('RelatedProduct', 'Model');

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
		'app.related_product',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RelatedProduct = ClassRegistry::init('RelatedProduct');
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
