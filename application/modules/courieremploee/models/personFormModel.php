<?php

class personFormModel extends abstract_formDbModelClient {
	
	public function init(){
		
		//$this->foreignKey = 'id_person';
	}
	
	protected function _setupTableName()
    {
        $this->_name = 'person';
        parent::_setupTableName();
    }
}
?>