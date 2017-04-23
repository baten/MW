<?php
App::uses('Gallery', 'Timeout.Model');

/**
 * Gallery Test Case
 *
 */
class GalleryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.timeout.gallery'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Gallery = ClassRegistry::init('Timeout.Gallery');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gallery);

		parent::tearDown();
	}

}
