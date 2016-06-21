<?php

/**
 * test case.
 */
class sysTest extends PHPUnit_Framework_TestCase {
	public $system;
	public $param;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		$this->system = new Class_System();
		
		$this->param = array( 'module' => null, 'controller' => null, 'action' => null);
		
	// TODO Auto-generated sysTest::setUp()

	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated sysTest::tearDown()
		

		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	public function testnullInArray()
	{		
		 $this->assertNull( $this->system->build( $this->param ) );				
	}

}

