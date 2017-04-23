<?php
App::uses('WebPageDetail', 'Model');

/**
 * WebPageDetail Test Case
 *
 */
class WebPageDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.web_page_detail',
		'app.web_page'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WebPageDetail = ClassRegistry::init('WebPageDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WebPageDetail);

		parent::tearDown();
	}

}
