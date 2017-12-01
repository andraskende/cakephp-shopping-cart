<?php
App::uses('Library', 'Model');

/**
 * Library Test Case
 */
class LibraryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.library'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Library = ClassRegistry::init('Library');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Library);

		parent::tearDown();
	}

}
