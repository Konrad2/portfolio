<?php

class Log_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	
	protected function _initAutoload() {
		
		
		throw new Exception('hellow world z booddstrap Module');
		
		//Zend_Auth::getInstance()->setStorage( new Log_library_AuthStorage() ); 
	}
	
}

?>