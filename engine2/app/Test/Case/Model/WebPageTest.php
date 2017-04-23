<?php
App::uses('WebPage', 'Model');

/**
 * WebPage Test Case
 *
 */
class WebPageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.web_page'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WebPage = ClassRegistry::init('WebPage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WebPage);

		parent::tearDown();
	}

}
