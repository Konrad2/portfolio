<?php

/** 
 * @author Konrad
 * @package formDb
 * 
 */
class FormDb_models_Edit extends FormDb_models_FormDb {
	
/**
 * Zwraca zaktualizowany wiersz.
 * 
 * @return Zend_Db_Table_Row
 * @param $row
 * @param $data
 * @param $values
 * 
 * W tym wypadku jest to nazwa klucza kturego aktualizujemy.
 * @param $foreignKey 
 */
public function doUpdate( $row = null, $data = null, $values = null, $foreignKey = null ) {		

		/**
		 * Wartosć klucza głównego.
		 * @var $valueForeignKey int 
		 */
		$valueForeignKey = Class_array::getValue( $data, $foreignKey );
		
		
		
			//ToDo je�li nie znajdzie to si� wysypie
			$currentRow = $this->find( $valueForeignKey )->current();
			
			if ( $currentRow  !== null )	{
				
				
				foreach ( $currentRow ->toArray() as $key => $v ) {
				
				
						$currentRow [ $key ] = Class_array::getValue($data,$key);
						
				}
				
				
				$currentRow ->save();
				
				
			} else {
			
				 Throw new Models_Exceptions_noRowFoundException ( 'FormDb_models_Edit->doUpdate. Nie znalazłem rekordu.' );
				
			}

		return $currentRow ;
		
	}
	

}

?>