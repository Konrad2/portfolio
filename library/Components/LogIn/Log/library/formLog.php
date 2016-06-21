<?php

/** 
 * Forma do logowania
 * @author Konrad 
 * @package Log
 */
class LogIn_Log_library_formLog extends Abstract_library_formLog {
	
	public function init(){
		
		
		$this->addElement( new LogIn_Log_library_FormElementLogin() );
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Haslo');	
		$this->addElement($password);
		
		$btn = new Zend_Form_Element_Submit('Zaloguj');
		$btn->setIgnore(true);			
		$this->addElement($btn);
		
		$this->setAction('log');
	}

}

?>