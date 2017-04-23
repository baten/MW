<?php
App::uses('ProductOrderNote', 'Ecommerce.Model');

/**
 * ProductOrderNote Test Case
 *
 */
class ProductOrderNoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.product_order_note',
		'plugin.ecommerce.product_order'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductOrderNote = ClassRegistry::init('Ecommerce.ProductOrderNote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductOrderNote);

		parent::tearDown();
	}

}
