<?php

/** 
 * @author Konrad
 * 
 * 
 */
class LogIn_RecallPswd_library_ValidatorLoginExists extends Class_Validators_FieldExist {

	
	protected $_defaultTableName = 'account';
	
	protected $_defaultColumnName = 'login';	
	
	
	public function __construct() {
		
			$this->_tableName = $this->_defaultTableName;
		
			$this->_columnName = $this->_defaultColumnName ;
		
	}
	
}

?>