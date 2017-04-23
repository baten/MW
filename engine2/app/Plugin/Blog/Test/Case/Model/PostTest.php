<?php
App::uses('Post', 'Blog.Model');

/**
 * Post Test Case
 *
 */
class PostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.blog.post',
		'plugin.blog.comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Post = ClassRegistry::init('Blog.Post');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Post);

		parent::tearDown();
	}

}
