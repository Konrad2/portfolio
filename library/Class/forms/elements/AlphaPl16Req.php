<?php

class Class_forms_elements_AlphaPl16Req  extends Zend_Form_Element_Text{
	
	 public function __construct($spec, $options = null) {
	
		parent::__construct($spec, $options);	 	
	 	
		$this->addValidator(new Zend_Validate_StringLength(1, 16), true)
			->addValidator(new Class_Validators_tekstPl())
			->setRequired(true);
	}

}