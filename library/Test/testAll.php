<?php

/** 
 * @author Konrad
 * 
 * 
 */
class AllTests 
{
	/**
	 * Konfiguruje obiekt zestawu testow
	 *
	 * @return PHPUnit_Framework_TestSuite
	 */
	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite('Package');
		$suite->addTest(Package_AllTests::suite());
 
		return $suite;
	} // end suite();
} // end AllTests;


?>