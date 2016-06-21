<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createaccount_library_form
 *
 * @author Konrad
 */
class components_createaccount_library_forms_form extends Zend_Form {
    //put your code here
    
  public function __construct($options = null){
  	
  	parent::__construct($options);
  	
  	$name=  new Class_forms_elements_AlphaPl64Req ('name',array('label'=>'Imię', ));
  	
  	$this->addElement($name);
  	$this->addElement( new Class_forms_elements_AlphaPl64Req ('surname',array('label'=>'Nazwisko')));
  	
  	$login = new Class_forms_elements_AlphaPl64Req ('login',array('label'=>'Login'));
  	$login->addValidator( new Zend_Validate_Db_NoRecordExists(
		    array(
		        'table' => 'account',
		        'field' => 'login'
		    	)
			));
  	$login->setAttrib('onblur', 'checkIfLoginExist()');
  	$this->addElement( $login );  	
  	
  	$email = new Class_forms_elements_EmailAddress('email',array('label'=>'e-mail'));
  	$email->addValidator( new Zend_Validate_Db_NoRecordExists(
		    array(
		        'table' => 'account',
		        'field' => 'email'
		    	)
			));
	$this->addElement( $email);
	
	$password = new Zend_Form_Element_Password ('password',array('label'=>'Hasło'));
	$password->addValidator( new Class_Validators_atLeastOneNumber())
		->addValidator( new Class_Validators_atLeastOneBigLetter())
		->addValidator( new Zend_Validate_StringLength(6, 64), true, array('messages'=>array('stringLengthTooShort'=>'Cannot be empty')));
  	$this->addElement( $password );
  	
  
  	
  	$confirmPswd = new Zend_Form_Element_Password ('confirmPassword',array('label'=>'Powtórz Hasło'));
  	$confirmPswd->addValidator('Identical', false, array('token' => 'password', 'messages'=>'Hasła nie są identyczne' ))
  				->setRequired(true);
  	$this->addElement( $confirmPswd );
  	
  	$this->addElement( new Zend_Form_Element_Submit('Wyślij'));
  }
}


