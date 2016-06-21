<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Validators_Paswd_ConfirmPaswd extends Zend_Validate_Abstract {
	
	
	const MSG_UNCORRECT = 'NotSame';
	
	protected $_messageTemplates  = array(

    	self::MSG_UNCORRECT =>"Podane chasa nie sa jednakowe",

    );
	
    
    
	public function isValid( $value ) {
			
	
	        $this->_setValue( $value );
	
	        
	      	$reg = Zend_Registry::getInstance();
	      	
	      	
	      	$confirm = $reg->get('confirmPaswd');
	      	
	  	      	
	      	if ( $value === $confirm ) {

	      		
	      			return true;
	      		
	      	
	      	} else {
	      	
	      		
	      		$this->_error( self::MSG_UNCORRECT );
	      		
	      		return false;
	      		
	      	}
	        
	      	
	    }

	    
}

?>