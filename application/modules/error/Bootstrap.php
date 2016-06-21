<?php
 		  
class Error_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	
	protected function _initAutoload() {

		$fc = Zend_Controller_Front::getInstance();
		
		 $fc->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(
            array(
                'module' => 'error',
                'controller' => 'error',
                'action' => 'error'
        )));
	}
	
}

?>