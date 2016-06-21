<?php

class myZend_Validate_StringLength extends Zend_Validate_StringLength {

	 public function __construct($options = array()){
	 	
    	parent::__construct($options);
		$this->setMessage('Zawartość pola przekracza dozwoloną ilość znaków');
    }
}

?>