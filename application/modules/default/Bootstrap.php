<?php
 		  
class default_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	
	protected function _initAcl(){
		
		
		
		$myAcl = Class_myAcl::getInstance();
		
		// Things module
 
		if ( ! in_array ( 'index:nysart' , $myAcl->getResources() ) ) {
		
				/*		
				$myAcl->add( new Zend_Acl_Resource( 'default:www.nysart.pl' ) );
				
				$myAcl->add( new Zend_Acl_Resource( 'index:nysart' ) );
			
				$myAcl->allow ('guest' , 'index:nysart', array('index', 'nysart') );
				
				$myAcl->allow ('guest' , 'default:www.nysart.pl', array('index', 'nysart') );
				
				
				
				*/
				Class_myAcl::setInstance( $myAcl );
		}
		
	}
	
	
	protected function X_initRouters(){
		
		
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
	
	
	protected function _initAutoload() {
		
		
		//throw new Exception('hellow world z booddstrap Module');
		
		//Zend_Auth::getInstance()->setStorage( new Logx_library_AuthStorage() ); 
	}
	
}

?>