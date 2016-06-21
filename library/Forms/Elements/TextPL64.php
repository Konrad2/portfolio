<?php

class Forms_Elements_TextPL64 extends Forms_Elements_aTextPl {

		 public function __construct($spec, $options = null){
	 		 	
    			parent::__construct($spec, $options ); 
    	
    			$this->addValidator(new myZend_Validate_StringLength(array('max=>64')));
		 }
}

