<?php

/** 
 * @author Konrad
 * @package Address
 * 
 */
class address extends abstract_formDbModelClient {
	
	public function init(){
		
		$this->foreignKey = 'id_address';
	}
	/**
	 * Wstawia nowy wiersz. Jako wartoœci wstawia pola formólarza zdefiniowane w addressFormDb.
	 * @param $row Zend_Db_Row nowiony wiersz z rodzica.
	 * @param $data array dane z formólarza
	 * @param $values
	 */
	/*
	public function doInsert($row = null, $data = null, $values = null){
		
		$newRow = $this->createRow();
		
		foreach ($newRow->toArray() as $key => $v){

			$newRow[$key] = $data[$key];
		}
		
		$id = $newRow->save();
		$row->id_address = $id;
		
		$row->save();
		
		return $newRow;
	}
	*/
}

?>