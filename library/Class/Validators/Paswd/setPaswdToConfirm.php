<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Validators_Paswd_setPaswdToConfirm extends Zend_Validate_Abstract {
	
	
	public function isValid( $value ) {
		

        $this->_setValue( $value );

        
      	$reg = Zend_Registry::getInstance();
      	
      	
      	$reg->set('confirmPaswd', $value );
        
      	
      	return true;
      	
    }
    

}

?>