<?php

/** 
 * @author Konrad
 * 
 * 
 */
class AuthStorage implements Zend_Auth_Storage_Interface {
	
	
	private $__sesionStorage;
	
	private $__defaultRole = 'guest';
	
	
	public function __construct() {
		
		
		$this->__sesionStorage = new Zend_Session_Namespace( 'RoleSorage' );
		
		
		if ( ! isset( $this->__sesionStorage->role ) )
		

				$this->__sesionStorage->role = $this->__defaultRole;
		
	}
	
	
    /**
     * Returns true if and only if storage is empty
     *
     * @throws Zend_Auth_Storage_Exception If it is impossible to determine whether storage is empty
     * @return boolean
     */
	
    public function isEmpty() {
    	
    	return false;
        /**
         * @todo implementation
         */
    	//return ! ( isset ( $this->__sesionStorage->role ) );
    }

    
    /**
     * Zwraca nazwe roli (Zawartosc pamieci).
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws Zend_Auth_Storage_Exception If reading contents from storage is impossible
     * @return mixed
     */
    
    public function read() {  	
     
	        
        return $this->__sesionStorage->role;
               
    }

    
    
    /**
     * Writes $contents to storage
     *
     * @param  mixed $contents
     * 
     * @throws Zend_Auth_Storage_Exception If writing $contents to storage is impossible
     * 
     * @return void
     * 
     */
    
    public function write( $contents ) { 
    			 					
    	
    	if ( ( $contents === null ) || ( empty ( $contents ) ) )
    	
    	    	 
    			throw new Exception(  "nazwa roli jest pusta. Klasa authStore." );
    		
    		
	 	$this->__sesionStorage->role = $contents;
	 	
    }

    
    
    /**
     * 
     * Clears contents from storage
     *
     * @throws Zend_Auth_Storage_Exception If clearing contents from storage is impossible
     * 
     * @return void
     * 
     */
    
    public function clear() {

    	
    		unset ( $this->__sesionStorage->role );
    		
    }
    
    
}
?>