<?php

class Abstract_models_viewModel extends Zend_Db_Table {
	
	
	public function setTableName( $tableName ){
		
		$this->_name = $tableName;
		
	}
	
	/*
	public function getId( $tableName, $value ){
		
		
		$select = $this->getSelect();
		
		$select->where( $this->getAdapter()->quoteInto( $tableName .'= ?', $value ) );
		
		$result = $this->fetchAll( $select );
		
		var_dump(  $this->getAdapter()->quoteInto( $tableName .'= ?', $value ) );
	}
*/
}

?>