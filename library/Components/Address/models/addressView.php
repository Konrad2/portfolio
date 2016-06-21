<?php

class addressView extends abstract_viewModel {
	
	public function init(){
		
		parent::init();
		
		$this->setForeignKey('id_address');
		
	}
	
	protected function _setupTableName(){
		
        $this->_name = 'address';
        parent::_setupTableName();
    }

}

?>