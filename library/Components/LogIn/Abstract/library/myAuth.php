<?php

/**
 * 
 * myAuth. pierwszy Singleton. Napisany intuicyjnie.
 * 
 * @author Konrad
 * 
 * @version 
 * 
 */



abstract class LogA_library_myAuth extends Zend_Auth {
	
	
	/**
	 * The default table name 
	 */
	
	protected $_name = 'account';
	
	private $__nameLoginColumn = 'login';
	
	private $__namePasswordColumn = 'password';
	
	
	
	

	
	abstract public function loog( $login, $password ) ;
	
	

}

