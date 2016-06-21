<?php
/**
 * Metoda odpowiada za dodanie wiersza do bazy danych.
 * @author Konrad
 * @package FormDb
 *
 */
interface interfaces_formDb_model {
	
	/**
	 * Funkcja wstawiaj¹ca wierz do bazy danych.
	 * @param unknown_type $row
	 * @param unknown_type $data
	 * @param unknown_type $values
	 * @param string $foreignKey klucz obcy do tabeli.
	 */
	public function doInsert($row = null, $data = null, $values = null, $foreignKey = null);
	
	/**
	 * Pobiera wszystkie wiersze z nazwami kture maj¹ pojawiæ siê w formularzu.
	 * @return Zend_Db_Table_Row 
	 */
	public function getNames($colName);
	
	
}

?>