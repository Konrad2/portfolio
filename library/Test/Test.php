<?php

/**
 * test case.
 */
class test_Test extends PHPUnit_Framework_TestCase {
	private $xpatch;
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
	// TODO Auto-generated Test::setUp()
		$this->xpatch = new xpatch();

	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated Test::tearDown()
		
	unset ($this->xpatch);
	
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	public function testXpatch()
	{
		 $this->assertTrue( Class_xpatch::arrayToXpatch( array() ) );
	}
	
	

}

