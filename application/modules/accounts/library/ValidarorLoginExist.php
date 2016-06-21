<?php

/** 
 * @author Konrad 
 * @package Validators
 */

class ValidarorLoginExist extends Zend_Validate_Abstract {
	
	
	const MSG_NOTAVALIBLE = 'msgNotAValible'; 
	
	
	protected $_messageTemplates  = array(

    	self::MSG_NOTAVALIBLE =>"Login '%value%' juz istnieje.",

    );
   
 
    
	public function isValid( $value ) {
		

        $this->_setValue( $value );

        
        require_once '../application/modules/accounts/models/account.php';
        
        $model = new account();
        
		
 		 if ( ! $model->loginInAvalible( $value ) ) {

 		 	
             $this->_error( self::MSG_NOTAVALIBLE );
           
          	  return false;

        } 
        

        return true;       
        
    }
    

    
}

?>