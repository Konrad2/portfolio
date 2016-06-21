<?php

class Forms_Elements_Email extends Zend_Form_Element_Text {

	 public function __construct($spec, $options = null)
    {
    	parent::__construct($spec, $options);
    	
    	$this->addFilter('StringTrim');
    	$this->addFilter('StripTags');
    	
    	$vEmail=new myZend_Validate_EmailAddress();
  
    	$this->addValidator($vEmail);
    	$vLength = new Zend_Validate_StringLength(array('max' => 64));
    	$vLength->setMessage('Pole nie może zawierać więcej niż 64 litery');
    	
    	$this->addValidator ($vLength);	

    	

    }
}
