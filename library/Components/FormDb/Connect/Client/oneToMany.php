<?php

/** 
 * @author Konrad
 * 
 * @package formDb
 */
class FormDb_Connect_Client_oneToMany extends FormDb_Connect_Client_Client {
	
	

	/**
	 * @return FormDb_Connect_models_oneToMany
	 */	
	public function getModel() {
		
	
		$model = new FormDb_Connect_Client_models_oneToMany( array ( 'name' => $this->_tableName ) );
		
		return $model;
		
	}
}

?>