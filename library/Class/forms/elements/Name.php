<?php

class Class_forms_elements_Name extends Class_forms_elements_AlphaPl64Req {
	
	 public function __construct($spec, $options = null) {	
		parent::__construct($spec, $options);	
		
		$validator = new Class_Validators_NameValidator();
		$this->addVBalidator( $validator );
		
	 }

	
}

