<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Validators_FieldExist extends Zend_Validate {

	
	protected $_tableName;
	
	protected $_columnName;
	
	
	public function construct() {		
		
		
			$this->setMessage('Podany login nie istnieje');
	}

	
	public function isValid ( $value ) {
		
			
		$table = new Zend_Db_Table( array ('name' => $this->_tableName ) );
		
		
		$row = $table->fetchRow ( $table->getAdapter()->quoteInto( $this->_columnName . '= ?',  $value  ) );
		
		
		return ( $row !== null )? true : false ;
		
	}
}

?>