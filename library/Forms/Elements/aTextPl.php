<?php

 class Forms_Elements_aTextPl extends Zend_Form_Element_Text {

	 public function __construct($spec, $options = null){
	 		 	
    	parent::__construct($spec, $options );    		
    	$this->addValidator( new myZend_Validate_TextPl() );
    }
}

?>