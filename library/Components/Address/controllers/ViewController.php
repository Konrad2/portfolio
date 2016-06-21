<?php

/**
 * ViewController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Components_Address_controllers_ViewController extends Editadddelete_controllers_ManagementController {

	
	
/*	
	protected function _redirectAfrerEdit(){
		
		$this->_redirect ( '/'.Sale/View/viewone/id'.
								
	          					, array('code' => 303 ));
			'Sale','controller'=>'View', 'action'=>'viewone', 'id'=>$this->_request->getIntParam('id'))
	}
	*/
	
	protected function createFormDb(){

		$formAddress = new Components_Address_library_forms_Address();

		return $formAddress;
	}
	
	//protected function getFormDb(){
		
//	}

}