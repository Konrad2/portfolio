<?php

/**
 * 
 * myAuth. pierwszy Singleton. Napisany intuicyjnie.
 * 
 * @author Konrad
 * 
 * @version 
 * 
 */



class Class_myAuth {//extends Zend_Db_Table_Abstract {
	
	
	/**
	 * The default table name 
	 */
	
	protected $_name = 'account';
	
	private $__nameLoginColumn = 'login';
	
	private $__namePasswordColumn = 'password';
	
	
	
	
	private function __construct(){		
	}
	
	private function create(){
		
		
		$ns = new Zend_Session_Namespace ('myAuth');
		
		$ns->myAcl = $this;
	}
	
	
	
	public static function getInstance() {
				
		
		$ns = new Zend_Session_Namespace ('myAuth');
		
		
		$out = null;
		
		if ( isset ( $ns->myAcl ) && ( $ns->myAcl instanceof Class_myAuth ) ) {
			
		
			$ns = new Zend_Session_Namespace ('myAuth');
		
			
			
			$out = $ns->myAcl;					
				
				
		} else {

			
			$out = new Class_myAuth();
			
			$ns->myAcl = $out;
						
					
		}

		
		return $out;
		
	}
	
	
	/**
	 * 
	 * Odwoujc sie do tabel z urzytkownikami sprawdza czy osoba istnieje oraz czy haslo przodane odpowiada temu kontu.
	 * 
	 * @param string $login
	 * 
	 * @param string $password
	 * 
	 */
	
	public function loog( $login, $password ) {
		
		
		$authAdapter = new Zend_Auth_Adapter_DbTable( Zend_Db_Table::getDefaultAdapter(), $this->_name ,
	    															$this->__nameLoginColumn,  $this->__namePasswordColumn );
	 		

	  
	 	$authAdapter->setIdentity( $login )
	 	
	 				  ->setCredential( $password  );	 	
	 
	 				  
	 	$auth = Zend_Auth::getInstance();		 		
	 				
	 	$result = $auth->authenticate( $authAdapter );	 

	 	 	
	 	$out = $result->isValid();	
	 	 	
	 	
	 	if ( $out ) {			

	 		
	 			$authResultRow = $authAdapter->getResultRowObject();	 			
	 			
	 			$auth->setStorage( $this->getStorage( $authResultRow->id_privilege ) );
	 		
	 	}
	 		 			

	 	return $out;	 	
	 	
	}
	
	
	
	/**
	 * 
	 * Zwraca obieklt typu AuthStorage, z zaimplementowana nazwa roli wedug id przywileju, przekazanego w parametrze $id_privilages.
	 * 
	 * @param unknown_type $id_privileges
	 * 
	 * @return AuthStorage 
	 * 
	 */
	
	private function getStorage( $id_privilege ) {
		
			
		require_once '../application/modules/accounts/models/Privileges.php';
		
		$privilages = new Privileges();	 							
	 					 					 				
	 	$role = $privilages->getRole( $id_privilege );

	 	
	 	require_once '../application/modules/accounts/library/AuthStorage.php';
	    
	 	$storage = new AuthStorage();	 	

	 	$storage->write( $role );
	 	
	 	
	 	return $storage;
	 	
		
	}
	

}

