<?php
App::uses('Comment', 'Blog.Model');

/**
 * Comment Test Case
 *
 */
class CommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.blog.comment',
		'plugin.blog.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comment = ClassRegistry::init('Blog.Comment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comment);

		parent::tearDown();
	}

}
