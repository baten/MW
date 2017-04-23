<?php
App::uses('TypeCategory', 'Ecommerce.Model');

/**
 * TypeCategory Test Case
 *
 */
class TypeCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.ecommerce.type_category',
		'plugin.ecommerce.type',
		'plugin.ecommerce.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TypeCategory = ClassRegistry::init('Ecommerce.TypeCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TypeCategory);

		parent::tearDown();
	}

}
