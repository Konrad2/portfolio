<?php

class Class_forms_elements_EmailAddress extends Zend_Form_Element_Text {
	
	 public function __construct($spec, $options = null)
    {
    	parent::__construct($spec, $options);    						
    	$this->addValidator( new Class_Validators_AdressEmail());  
    	$this->addFilters(array('StringTrim', 'StripTags'));	
    }	
}

