<?php

/** 
 * Inaczej dodaje rekord.
 * @author Konrad 
 * @package FormDb
 */
abstract class abstract_formDbModelParent extends abstract_formDbModelClient{

	
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
		
		
		$newRow = $this->find($values)->current();
		
		
		if ($newRow !== null) {
			
			
			foreach ($newRow->toArray() as $key => $v){
	
				if (isset( $data[$key] ))
								
						$newRow[$key] = $data[$key];
				
			}
			
			
			$newRow['exist'] = 1;
			
			$newRow->save();
			
		} else 
		
			throw new Exception('nie można odnaleść rekordu do aktualiczacji');
		
			
		return $newRow;
		
	}
	
}

?>