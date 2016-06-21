<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_Resourcse_frontControllerx extends Zend_Application_Resource_ResourceAbstract {
	
	public function init(){
		
			$frontController = Zend_Controller_Front::getInstance();
		//$frontController->throwExceptions(true);
		//$frontControllerx->throwExceptions(false);
		//$frontController->setParam('noErrorHandler', false);
		$frontController->registerPlugin(new initAppli());
		$frontController->registerPlugin(new Class_logCheck());
		//TODO $frontControllerx->registerPlugin(new Class_layout);
		
		$frontController->setBaseUrl('/new/');
						
		//require_once('../application/modules/view/controllers/ViewController.php');	
		
		$frontController->addModuleDirectory('../application/modules');	
		
	}
}

?>