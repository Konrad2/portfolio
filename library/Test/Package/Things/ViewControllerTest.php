<?php

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * Test kontrollera Things_ViewController
 * @author Konrad
 * @package Tests
 * @subpackage View
 * @date 17-08-2010
 * 
 */
class ViewControllerTest extends PHPUnit_Framework_TestCase {
	
	protected $viewController;
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		// TODO Auto-generated ViewControllerTest::setUp()
		require_once '../application/modules/things/controllers/ViewController.php';
		
		$this->viewController = new Things_ViewController();	
	}
	
	
	public function testAll()
	{
		$this->$this->assertEquals(0, $this->viewController->viewallAction());
	}
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ViewControllerTest::tearDown()
		
	  	unlink($this->viewController);
	  		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}

}

