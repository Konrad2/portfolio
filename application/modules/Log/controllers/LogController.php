<?php

/**
 * LogController
 * 
 * @author
 * @version 
 */																
//require_once '../library/Components/LogIn/Log/controllers/LogController.php';
							
//class Log_LogController extends LogIn_Log_controllers_LogController {
class Log_LogController extends LogIn_RecallPswd_controllers_RecallPswdController {	
	
	public function init(){
		
		$this->_redirectTo = 'Cms/Management/viewone/id/1';
	}
}