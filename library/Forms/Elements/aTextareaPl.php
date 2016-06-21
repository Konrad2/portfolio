<?php

class Forms_Elements_aTextareaPl extends Zend_Form_Element_Textarea {
	
 public function __construct($spec, $options = null){
	 		 	
    	parent::__construct($spec, $options );    		
    	$this->addValidator( new myZend_Validate_TextPl() );
    }

}

?>