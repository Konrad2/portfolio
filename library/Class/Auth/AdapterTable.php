<?php

/**
 * 
 * AdapterTable. pierwszy Singleton. Napisany intuicyjnie.
 * 
 * @author Konrad
 * 
 * @version 
 * 
 */



class Class_Auth_AdapterTable extends  Zend_Auth_Adapter_DbTable {//extends Zend_Db_Table_Abstract {
	
	
	/**
	 * The default table name 
	 */
	
	protected $_name = 'account';
	
	private $__nameLoginColumn = 'login';
	
	private $__namePasswordColumn = 'password';
	
	
	public function __construct(){

		parent::__construct( Zend_Db_Table::getDefaultAdapter(), $this->_name ,
	   															$this->__nameLoginColumn,  $this->__namePasswordColumn );
	}
/*	
	public function init(){
		
		
		$this->_setDbAdapter( Zend_Db_Table::getDefaultAdapter() );
		
		$this->setTableName( 'account' );
		 
		$this->setIdentityColumn( $this->__nameLoginColumn );
		
		$this->setCredentialColumn ( $this->__namePasswordColumn );
	}
*/
	
	/**
	 * Zalogowuje. 
	 * Odwoujc sie do tabel z urzytkownikami sprawdza czy osoba istnieje oraz czy haslo podane odpowiada temu kontu.
	 * 
	 * @param string $login
	 * 
	 * @param string $password
	 * 
	 * @return ResultRowObject or nul if autentication false.
	 * 
	 */
	
	public function loog( $login, $password ) {
		
		
		//$authAdapter = new Zend_Auth_Adapter_DbTable( Zend_Db_Table::getDefaultAdapter(), $this->_name ,
	  //  															$this->__nameLoginColumn,  $this->__namePasswordColumn );
	 		

	  
	 	$this->setIdentity( $login )
	 	
	 				  ->setCredential( $password  );	 	
	 
	 				  
	 	$auth = Zend_Auth::getInstance();		 		
	 				
	 	$result = $auth->authenticate( $this );	 

	 	 	
	 	$out = null;	
	 	 	
	 	
	 	if ( $result->isValid() ) {			

	 		
	 			$out = $this->getResultRowObject();	 			
	 				 				 		
	 	}
	 		 			

	 	return $out; 	
	 	
	}
	
	
	
	
	

}

