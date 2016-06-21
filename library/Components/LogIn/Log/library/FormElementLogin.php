<?php

class LogIn_Log_library_FormElementLogin extends Class_forms_alNum20Req {

	
	protected $_defaultLabel = 'Login';
	
		
	 public function __construct($spec = 'login', $options = null) {
	
	 	
	 	parent::__construct($spec, $options);
	 	
	 	
	 	$this->setLabel ( $this->_defaultLabel ) ;
	 	
	 	$this->setAttrib('onblur','checkloginexist()');
	 	
	 		$this->setAttrib('id','login');
	 	
	 }
}

?>