<?php
App::uses('CategoryImage', 'Ecommerce.Model');

/**
 * CategoryImage Test Case
 *
 */
class CategoryImageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.category_image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CategoryImage = ClassRegistry::init('Ecommerce.CategoryImage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CategoryImage);

		parent::tearDown();
	}

}
