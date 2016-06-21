<?php

class Class_forms_elements_AlphaPl32Req  extends Zend_Form_Element_Text{
	
	 public function __construct($spec, $options = null) {
	
		parent::__construct($spec, $options);	 	
	 	
		$this->addValidator(new Zend_Validate_StringLength(1, 32), true)
			->addValidator(new myZend_Validate_TextPl())
			->setRequired(true);
	}

}