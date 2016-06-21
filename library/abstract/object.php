<?php

/** 
 * @author Konrad
 * 
 */
abstract class abstract_object {

	protected $error;

	public function __construct(){

		set_error_handler(array(&$this, 'errorHandler'));
	}

	public function getError(){

		return $this->error;
	}

	function errorHandler($errno, $errstr, $errfile, $errline){
		//TODO - Zapis do pliku.
		
		$this->error = $errno.', '. $errstr.', '.', '.$errfile.' w lini nr.'.$errline;
		
		echo 'error handler '.$this->error;
	}
}

?>