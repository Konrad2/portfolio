<?php

/** 
 * @author Konrad
 * 
 * @package Pay
 */
class payView extends abstract_viewModel {
	
	public function init(){
		
		$this->setForeignKey('id_paying');
	}
	protected function _setupTableName()
    {
        $this->_name = 'pay';
        parent::_setupTableName();
    }
    
	protected function getCol(){
		
		return array('id','Rodzaj płatności'=>'pay_type');
	}

}
