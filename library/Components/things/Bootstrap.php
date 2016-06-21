<?php
 		  
class Things_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	
	protected function _initAcl(){
		
		
		
		$myAcl = Class_myAcl::getInstance();
		
		// Things module
 
		if ( ! in_array ( 'things:management' , $myAcl->getResources() ) ) {
		
				//$myAcl->add(new Zend_Acl_Resource( 'things:index' ) );
					
				//$myAcl->add(new Zend_Acl_Resource( 'things:view' ) );
						
				$myAcl->add( new Zend_Acl_Resource( 'things:management' ) );
				
			//	$myAcl->add( new Zend_Acl_Resource( 'things:Picturemanager' ) );
						
				
			//	$myAcl->allow( 'guest', 'things:index', 'index' );
				//
				//$myAcl->allow( 'guest', 'things:view', array( 'viewall', 'viewone', 'move', 'search2', 'clear', 'getmain' ) );
				
			//	$myAcl->allow( 'guest', 'things:Picturemanager', array( 'next', 'previous', 'show' ) );
				
			//	$myAcl->allow( 'admin', 'things:Picturemanager', array( 'add', 'delete', 'setasmain' ) );
				
				$myAcl->allow( 'guest', 'things:management', array('viewall', 'viewone', 'move', 'search2', 'clear', 'getmain' ) );
				
				$myAcl->allow( 'admin', 'things:management', array( 'add', 'edit', 'delete' , 'addpict', 'deletepict', 'setasmain') );
				
				
				Class_myAcl::setInstance( $myAcl );
		}
		
	}
	
	
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
	
	
	protected function _initAutoload() {
		
		
		//throw new Exception('hellow world z booddstrap Module');
		
		//Zend_Auth::getInstance()->setStorage( new Logx_library_AuthStorage() ); 
	}
	
}

?>