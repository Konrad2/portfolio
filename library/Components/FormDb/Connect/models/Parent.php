<?php

/** 
 * Inaczej dodaje rekord.
 * @author Konrad 
 * @package formDb
 */
	  
class FormDb_Connect_models_Parent extends FormDb_Connect_models_aConnect {

	
	
	/**
	 * 
	 * @param Zend_Db_Table_Row $row
	 * @param unknown_type $data 
	 * @param unknown_type $values
	 * @param unknown_type $foreignKey
	 */
	public function doInsert($row = null, $data = null, $values = null , $foreignKey = null){
		
		
		$newRow = $this->createRow();
		
		foreach ($newRow->toArray() as $key => $v) {

			
			if ($key != 'id')
			
			
				if ( isset( $data[ $key ] ) )					
				
						$newRow[ $key ] = $data[ $key ];					
					
		}

		
		$newRow->save();
		
		
		return $newRow;
		
	}
	
	
					
	public function doUpdate($row = null, $data = null, $values = null , $foreignKey = null) {
		
	//	var_dump($values);
	//	die();
		$newRow = $this->find($values)->current();
		
		 		
		if ($newRow !== null) {
			
			
			foreach ($newRow->toArray() as $key => $v){
	
				if (isset( $data[$key] ))
								
						$newRow[$key] = $data[$key];
				
			}
			
			
			$newRow['exist'] = 1;
				//var_dump($newRow);
				//die();
			$newRow->save();
			
		} else 
		
			throw new Exception('Nie można odnalesć rekordu do aktualiczacji');
		
			
		return $newRow;
		
	}
	
	/**
	 * Zwraca obiekt FormDb_models_formDbModelParent.
	 */
	/*
	public function getModel() {
		
		
		
		$model = new FormDb_models_formDbModelParent( array ( 'name' => $this->_tableName ) );
		
		return $model;
		
	}
	*/
}

?>