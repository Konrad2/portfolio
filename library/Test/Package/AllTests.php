<?php

require_once 'PHPUnit\Framework\TestSuite.php';

/**
 * Static test suite.
 */
class Test_Package_AllTests extends PHPUnit_Framework_TestSuite {
	
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'Test_Package_AllTests' );
	
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		
		$suite = new Package_AllTests('Package');
		$suite->addTestSuite('Package_Things_viewController');
		//$suite->addTestSuite('Package_UmmobogorotitorTest');
		return $suit;
		//return new self ();
	}
}

