<?php

/**
 * accountsView
 * 
 * @author Konrad
 * @version 1.0
 */


//class accountsView extends Class_View_ModelSelect {
class accountsView extends abstract_viewModel {
	
	
	/**
	 * The default table name 
	 */
	
	protected $_name = 'account';
			
	
	
	public function init() {
		
		parent::init();
	
		
		$this->setForeignKey('id_account');
	
	}
	
 /*   
    protected function getColsRow() {
    	
    	
    	return array('id', 'Login'=>'login', 'e-mail'=>'email', 'id_address', 'id_person');
    	
    }
   */ 
    
    protected function getCol() {
    	
    	
    	return array('id', 'login'=>'Login', 'e-mail'=>'email');
    	
    }
    

}

