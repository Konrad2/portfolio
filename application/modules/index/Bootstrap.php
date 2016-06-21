<?php
 		  
class Index_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	
	protected function _initAcl(){
		
		
		
		$myAcl = Class_myAcl::getInstance();
		
		
 
		if ( ! in_array ( 'index:index' , $myAcl->getResources() ) ) {
		
				
				$myAcl->add(new Zend_Acl_Resource('default:index'));				
				
				$myAcl->add(new Zend_Acl_Resource('index:index'));
				
				//$myAcl->add(new Zend_Acl_Resource('index:www.nysart.pl'));
				
				 $myAcl->allow( 'guest','index:index',  array('index', 'new', 'about', 'ofer','reference','contact') );
				 
				$myAcl->allow( 'guest','default:index',array('index'));
				
				
				//$myAcl->allow( 'guest','index:www.nysart.pl');
				
				
				Class_myAcl::setInstance( $myAcl );
		}
		
	}
	
	/*
	protected function _initRouters(){
		
		
				$fc = Zend_Controller_Front::getInstance();
					
				$router = $fc->getRouter();
				
				$router->addRoute('produkty', new Zend_Controller_Router_Route('produkty',
				
		                                     array(
		                                     'module' => 'things',
		                                     'controller' => 'view',
		                                     'action' => 'viewall'))
		                              );
		                                     
		       $router->addRoute('log', new Zend_Controller_Router_Route('log',
				
		                                     array(
		                                     'module' => 'Log',
		                                     'controller' => 'log',
		                                     'action' => 'log')) );
	}
	*/
	
	protected function _initAutoload() {
		
		
		//throw new Exception('hellow world z booddstrap Module');
		
		//Zend_Auth::getInstance()->setStorage( new Logx_library_AuthStorage() ); 
	}
	
}

?>