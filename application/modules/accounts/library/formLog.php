<?php

/** 
 * Forma do logowania
 * @author Konrad 
 * @package Account
 */
class formLog extends Zend_Form {
	
	public function init(){
		
		$login = new  Class_forms_alNum20Req( 'login' );
		$login->setLabel('Login');
		$this->addElement($login);
		
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