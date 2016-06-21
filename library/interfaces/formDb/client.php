<?php

interface interfaces_formDb_client {
	
	
	public function formToDb($row=null, $data=null, $values = null);
	
	
	/**
	 * Podiera wiersz z bazy o danym id, nastempnie
	 * Wype³nia formularz danymi z rekordu.
	 * @param Zend_Db_Table_Row $parentRow
	 */
	
	public function fill ($parentRow);
	
	
}

?>