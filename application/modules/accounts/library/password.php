<?php
/**
 * @author Konrad
 * @version 1.0
 * @created 09-lip-2010 14:01:58
 */
class password extends Zend_Db_Table
{
	
	/**
	 * 
	 * @param email string
	 * @assert-in !empty
	 */
	 
protected function _setupTableName()
    {
        $this->_name = 'account';
        parent::_setupTableName();
    }
	function exist($login, $password)
	{
		$select = $this->select();
		$select->from($this->_name);
		$select->where( $this->getAdapter()->quoteInto('login = ?', $login) )
				->where( $this->getAdapter()->quoteInto('password = ?', $password ) );
				
		$result = $this->fetchRow($select);
		
		return $result === null ? false : true;
	}
	/**
	 * 
	 * @param email
	 * @todo zaimplementowac
	 */
	function insertPassword($email)
	{
	}
	/**
	 * 
	 * @param email
	 * * @todo zaimplementowac
	 */
	function updatePassword($email)
	{
	}

	/**
	 * @todo zaimplementowac
	 * @param unknown_type $email
	 */
	function deletePassword($email)
	{
	}
	
	public function getRole($id){
			
//		$rowSet = $this->find( $this->getAdapter()->quoteInto('id = ?', 1) );
		//$rowSet = $this->find( 1 );
	//	$row = $rowSet->current();

		//require_once '../application/modules/accounts/models/privilage.php';
		
		//$privilage = $row->findDependentRowset('privilage');
		//$privilage = $row->findDependentRowset('privilage', 'id_privilage');
	
		
		$select = $this->select();
		
		$select->from( $this->_name, array('privilage.role') );		
		
		$select->joinLeft( 'privilage', 'account.id_privilage = privilage.id' );
		
		$select->where( 'account.id = ?', $id );
				
		$select->setIntegrityCheck( false );
				
		
		$row = $this->fetchRow( $select );

		$result = null;
		
		
		if ( isset ( $row['role'] ) ) {
			
			$result = $row['role'];
			
		}
		
		
		return $result;
		
	}
	
	
	
}
?>