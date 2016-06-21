<?php


class personView extends abstract_viewModel {

	
	public function init(){
		
		
		parent::init();
	
		$this->setForeignKey('id_person');
		
	}
	
	
	
	protected function _setupTableName(){

		
        $this->_name = 'person';
        
        parent::_setupTableName();
        
    }
    
    
}


?>