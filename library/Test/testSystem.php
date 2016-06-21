<?php 


/**
 * test case.
 */

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/Framework/TestCase.php';

require 'D:/xampplite/htdocs/new/library/Class/system.php';
	  
class testSystem extends PHPUnit_Framework_TestCase{

	private $system;
	private $param;
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
	// TODO Auto-generated Test::setUp()
	
	
		$this->system = new Class_system();
		$this->param = array();

	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated Test::tearDown()
		
	unset ($this->myXml);
	
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	public function testNUll()
	{
		
		$this->assertNull( $this->system->build( $this->param ) );
		
	}
}


?>