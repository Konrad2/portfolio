<?php

/** 
 * @author Konrad
 * @package RecallPswd
 * 
 */
class RecallPswd_library_formRecallPswd extends Zend_Form {

	 public function __construct($options = null)
    {
    	parent::__construct($options);
    	
    	$this->_createForm();
    }
    
    
    protected function _createForm(){
    	
    	
		$this->addElement( new  LogIn_Log_library_FormElementLogin( array ( 'name'=>'login', 'validators'=>array( new LogIn_RecallPswd_library_ValidatorLoginExists() ) )) );
		
		$this->addElement( new Zend_Form_Element_Submit( 'Wyślij'));
		
    }
	
}

?>