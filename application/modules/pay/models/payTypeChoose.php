<?php

class payTypeChoose extends abstract_formDbModelClient {

	public function init(){
		
		$this->colName = 'id_type'; 
		$this->foreignKey = 'id_paying';
		$this->label = 'Sposób płatności';
	}
	
    protected function _setupTableName()
    {
        $this->_name = 'pay';
        parent::_setupTableName();
    }
}

