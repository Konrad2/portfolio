<?php

/** 
 * @author Konrad
 * @package FormDb
 * 
 */
abstract class FormDb_models_aFormDbModel extends Zend_Db_Table {
	
	
	abstract public function deleteEntite( $id );
	
//	abstract public function doInsert( $data );

	/**
	 * @return Zend_Db_Table_Row  zwraca warto�ci z podanej kolumny.
	 * @param string $foreignKey nazwa klucza obcego w tabeli od kturego prowarzi referencja.	
	 */
	public function  getNames($colName) {
		
		
		$select = $this->select();

		$select->from( $this->_name );
		
		$select->columns( $colName );
		
		$result =  $this->fetchAll( $select );
		
		
		return $result;
		
	}
}

?>