<?php

class Components_Category_models_formDbModel extends FormDb_Connect_Client_models_Client {
	
	
	
	public function getCategoryAndId(){
		
		$select = $this->select();
		
		$select->from( $this->_name, array('id','name') );
		
		$select->where('exist = 1');
		
		return $this->fetchAll( $select )->toArray();
	}

	
	public function doUpdate( $row = null, $data = null, $values = null, $foreignKey = null ) {	
		
		
		$resultRow = $row;
		if (!isset($row->id_category)){
			$resultRow = parent::doUpdate( $row, $data, $values, $foreignKey );			
		}
		return $resultRow;
	
	}
}

