<?php

class Forms_Elements_Name extends Zend_Form_Element_Text {
	
	public function __construct($spec, $options = null){
    	parent::__construct($spec, $options);
    	
    	$this->setAttrib('class',' medium');
    
    	$this->addValidator( new myZend_Validate_NotEmpty() );
    	
    	$this->setRequired(true);
    
    	$this->addFilter('StringTrim');
    	$this->addFilter('StripTags');
    	
    	$regex = new Zend_Validate_Regex('/^[a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]*$/');
    	$regex->setMessage('Pole może zawierać jedynie litery');
    	$this->addValidator ($regex);
    	//$this->addValidator ('regex', array('/^[a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]*$/',  array('message' => 'Pole może zawierać jedynie litery')));
    	$vLength = new Zend_Validate_StringLength(array('max' => 64));
    	$vLength->setMessage('Pole nie może zawierać więcej niż 64 litery');
    	$this->addValidator ($vLength);
    	/*
    	$this->setDecorators(array(
  		'ViewHelper',
 		'Description',
  		'Errors',
  		//array('HtmlTag', array('tag' => 'div', 'id'=>'tip')),
  		array('Label', array('tag' => 'div')),  		 		
  		));
  		*/  		  	
    }

}

?>