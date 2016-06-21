<?php

class Class_forms_elements_Num5Unsigned extends Zend_Form_Element {

	 public function __construct($spec, $options = null){
	 	parent::__construct($spec, $options);
	 	
	$this->addValidator(new Zend_Validate_Int ());
	$this->addValidator (new Zend_Validate_StringLength(0, 5));
	 }
}

