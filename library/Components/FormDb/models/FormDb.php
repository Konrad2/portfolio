<?php

/** 
 * @author Konrad
 * 
 * 
 */
class FormDb_models_FormDb extends FormDb_models_aFormDbModel {


	/**
	 * Ustawia na false rekordy(Usuwa).
	 * Tabela powinna zawiera� kolumn� exist (bool). W przeciwnym wypadku nalerzy nadpisa� procedur� delete.
	 */
	
	public function deleteEntite( $id ) {

		
		if (! is_int($id) ){
			throw new Exception('Nie można usunąć wiersza. Podane id nie jest liczbą całkowitą. FormDb_models_FormDb');
		}
		//$where = $this->getAdapter()->quoteInto('id =?',$id );
		
		//$rowset = $this->find($where);
	
		$rowset = $this->find($id);
		
		$depRow = $rowset->current();
		
		$depRow->exist = 0;
	
		$depRow->save();
		
		
	}
	
	/**
	 * Zwraca nowo utworzony wiersz.
	 * 
	 * @return Zend_Db_Table_Row
	 * @param $data
	 */
	
	public function doInsert( $data ) {		

		
				$newRow = $this->createRow();
			
				foreach ( $newRow->toArray() as $key => $v ) {
				
			
					$newRow[ $key ] = Class_array::getValue( $data, $key );
				
                                }
				$newRow->save();				
		
			
			return $newRow;
			
		//}
	}

}

?>