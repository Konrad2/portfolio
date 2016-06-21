<?php
 		  
class Log_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	
	/*
	protected function _initAcl() {
		
		
		$myAcl = Class_myAcl::getInstance();
		
		if ( ! in_array ( 'Log:log' , $myAcl->getResources() ) ) {
			
		
				$myAcl->add(new Zend_Acl_Resource('Log:log'));
				
				$myAcl->allow( 'guest','Log:log',array('log','out', 'recall'));
				
				
				$myAcl->add(new Zend_Acl_Resource('Log:View'));
				
				$myAcl->allow( 'admin','Log:View',array('viewone'));
				
				
				Class_myAcl::setInstance( $myAcl );
		}
				
	}
	*/
	
	protected function _initRouters(){
		
		
				$fc = Zend_Controller_Front::getInstance();
					
				$router = $fc->getRouter();
				
				   $router->addRoute('recall', new Zend_Controller_Router_Route(':module/:controller/recall',
				
		                                     array(
		                                     'module' => 'Log',
		                                     'controller' => 'log',
		                                     'action' => 'recall')) );
				
				$router->addRoute('adminX', new Zend_Controller_Router_Route('admin',
				
		                                     array(
		                                     'module' => 'Log',
		                                     'controller' => 'log',
		                                     'action' => 'log'))
		                              );
		                              
		     
		                                     
		       $router->addRoute('log', new Zend_Controller_Router_Route('log',
				
		                                     array(
		                                     'module' => 'Log',
		                                     'controller' => 'log',
		                                     'action' => 'log')) );
	}
	
	
	protected function _initAutoload() {
		
		
		//throw new Exception('hellow world z booddstrap Module');
		
		//Zend_Auth::getInstance()->setStorage( new Logx_library_AuthStorage() ); 
	}
	
}

?>