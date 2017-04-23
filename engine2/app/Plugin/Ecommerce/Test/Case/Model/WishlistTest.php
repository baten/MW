<?php
App::uses('Wishlist', 'Ecommerce.Model');

/**
 * Wishlist Test Case
 *
 */
class WishlistTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.wishlist',
		'plugin.ecommerce.client',
		'plugin.ecommerce.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Wishlist = ClassRegistry::init('Ecommerce.Wishlist');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Wishlist);

		parent::tearDown();
	}

}
