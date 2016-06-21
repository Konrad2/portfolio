<?php

/**
 * account
 * 
 * @author Konrad
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class account extends Zend_Db_Table_Abstract {
	
	
	/**
	 * The default table name 
	 */
	
	protected $_name = 'account';
		
	
	
	public function loginInAvalible( $login ) {		
		
		
		$select = $this->select();
		
		$select->where( $this->getAdapter()->quoteInto( 'login = ?', $login ) );
		
		$select->where( 'exist = 1' );
		
		$result =  $this->fetchAll( $select )->current();
		
		
		 if ( $result === null ) {
		 	
		 	
		 		return true;
		 	
		 } else {
		 	
		 	
		 		return false;
		 	
		 }
		
	}
	
	
}

