<?php

class Forms_Elements_mailSubiect extends Forms_Elements_aTextPl {
	
	 public function __construct($spec, $options = null){
	 		 	
    	parent::__construct($spec, $options );

    	$this->addValidator();
	 }

}

?>