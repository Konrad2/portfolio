<?php

class Forms_Elements_TextPL65536 extends  Forms_Elements_aTextareaPl {

		 public function __construct($spec, $options = null){
	 		 	
    			parent::__construct($spec, $options ); 
    	
    			$this->addValidator(new myZend_Validate_StringLength(array('max=>65536')));
		 }
}



