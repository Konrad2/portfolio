<?php

class formDb extends abstract_formDbModelClient {

	protected function _setupTableName(){
		$this->_name = 'category';
		
		parent::_setupTableName();
	}
	
	public function getCategoryAndId(){
		
		$select = $this->select();
		
		$select->from( $this->_name, array('id','name') );
		return $this->fetchAll( $select )->toArray();
	}
	
	public function doInsert($row = null, $data = null, $values = null, $foreignKey = null){	
		
		require_once '../application/modules/category/models/catThings.php';
		$c_t = new catThings();

		foreach( $data['category'] as $cat)
		{
			$RowManyToMany = $c_t->createRow();
			$RowManyToMany->id_category = $cat;
			$RowManyToMany->id_thing = $row->id;
			$RowManyToMany->save();
		}

		$row->id_category = $idManyToMany;
		$row->save();

		if ($this->child != null)
			$this->child->formToDb($newRow, $params);	
	}
	
}

?>