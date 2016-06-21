<?php

class LogIn_Log_library_PasswordManager extends Zend_Db_Table {

	protected $_name = 'account';
	
	
	
	/**
	 * Pobiera sól dla danego loginu.
	 * 
	 * @param string $login
	 */
	
	public function getSalt($login){
		
		$result = null;
		
	 	$rowset = $this->fetchAll( $this->select()->where($this->getAdapter()->quoteInto( 'login =?', $login ) ) );
	 	
	 	if ( count($rowset) ){
	 		$row = $rowset->current();
	 		$result = $row['salt'];
	 	}
	 	
	 	return $result;
	}
	
	/**
	 * Miesza chasło z solą.
	 * 
	 * @param string $password
	 * @param string $salt
	 */
	public function salts($password, $salt){
		
		return sha1( $password.$salt);
	}
	
	/**
	 * 
	 * Zwraca sól, wygenerowaną z czasu i funkcji haszującej sha1.
	 * @return string 
	 */
	public function createSalt(){		
		
		return sha1(time());
	}
}
