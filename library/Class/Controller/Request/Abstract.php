<?php

class Class_Controller_Request_Abstract extends Zend_Controller_Request_Abstract {
	
	private $__errorHandler;
/**
	 * Moja funkcja. 
	 * @param string $name nazwa parametru
	 * @param Zend_Validator $validator
	 */
    
	protected function _getParam( string $name, Zend_Validator $validator ) {
		
		
			$param = $this->getParam( $name );
			
			
			if ( ! $validator->isValid( $param ) )
					
					$param = null;		
		
					
		return $param;
		
	}
	
	
	
	public function getErrorCode(){
		
	}

}

?>