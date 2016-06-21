<?php

class Forms_Elements__Password extends Zend_Form_Element_Password{
	
 	public function __construct($spec, $options = null)
    {
    	parent::__construct($spec, $options);
    	
    	$this->addFilter('StringTrim');
    	$this->addFilter('StripTags');
    	
    	$regex = new Zend_Validate_Regex('/^[a-zA-Z0-9ąćęłńóśźżĄĘŁŃÓŚŹŻ!@#$%\^&*(){}[ <>?\/\[|\-_]*$/');
    	$regex->setMessage('Pole może zawierać jedynie liczby, litery oraz znaki specjalne ! @ # $ % \ ^ & * ( ) { } [   < > ? / | \ - _ ');
    	$this->addValidator ($regex);
    	
    	$vLength = new Zend_Validate_StringLength(array('max' => 128));
    	$vLength->setMessage('Pole nie może zawierać więcej niż 128 znaki');
    	$this->addValidator ($vLength);
    }

}

