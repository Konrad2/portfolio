<?php

/** 
 * @author Konrad
 * @package Log
 * 
 */
class Log_library_AuthStorage extends Abstract_library_AuthStorage {
	
	
	private $__defaultRole = 'guest';
	
	
		public function __construct() {
		
		
		$this->__sesionStorage = new Zend_Session_Namespace( $_SERVER['DOCUMENT_ROOT'] . 'RoleSorage');
		
		
		$this->__sesionStorage->setExpirationSeconds( Zend_Registry::get('timout') );
		
	
		
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
     * @return Log_Abstract_library_Client
     */
    
    public function read() {  	
     
    	
	      if ( isset( $this->__sesionStorage->role) ) {
	      	
	      
					
	      		return  $this->__sesionStorage->role;//->getRole();
	      		
	      }
	      		
	      else{
	    //  		require_once '../library/Components/LogIn/Log/library/Client.php';	   
       			return new LogIn_Log_library_Client();
	      }
               
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
    
    public function write( $client ) { 

    
    	
    	if ( ( $client === null ) || ( empty ( $client ) ) )
    	
    	    	 
    			throw new Exception(  "nazwa roli jest pusta. Klasa authStore." );
    		
    		
	 	$this->__sesionStorage->role = $client;
	 	
	 	//$this->__client = $contents;
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
    
    
    public function getRole(){
    	
    	return $this->read()->getRole();// $this->__sesionStorage->role->getRole();// $this->__client->getRole();
    	
    }
    
    
    public function setAuthObj($AuthRowObj){
    	
    }
    
    
 public function getData(){
    	
    	
    	
    }
    
    public function getId(){
    	
    }
}
?>