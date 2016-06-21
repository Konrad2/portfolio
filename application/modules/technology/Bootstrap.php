<?php
 		  
class Technology_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	
	
	protected function _initStyle() {
		
			 $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
	            'ViewRenderer'
	        );
	        
			$viewRenderer->view->HeadLink()->appendStylesheet(BASE_URL.'public/styles/technology.css');		
	}
	
	
	protected function _initMenu() {
		
	
		
		$menu = Zend_Registry::get('menu');
		
		$menu->addPage( new Zend_Navigation_Page_Mvc( array( 'label'=>'Technologie', 'module'=> 'technology', 'controller'=>'management', 'action' => 'viewall' ) ));
		
		Zend_Registry::set ('menu', $menu);
		
		
		
		$menuAdmin = Zend_Registry::get('menuAdmin');
		
		
		
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 'label'=>'Dodaj Technologie', 'module'=> 'technology', 'controller'=>'management', 'action' => 'add' ) ));
		
		Zend_Registry::set ('menuAdmin', $menuAdmin);
		
	}
	
	
	protected function _initAcl(){
		
		
		$myAcl = Class_myAcl::getInstance();
		
		// Things module
 							
		if ( ! in_array ( 'technology:management' , $myAcl->getResources() ) ) {
		
				//$myAcl->add(new Zend_Acl_Resource( 'things:index' ) );
					
				//$myAcl->add(new Zend_Acl_Resource( 'things:view' ) );
						
				$myAcl->add( new Zend_Acl_Resource( 'technology:management' ) );
				
			//	$myAcl->add( new Zend_Acl_Resource( 'things:Picturemanager' ) );
						
				
			//	$myAcl->allow( 'guest', 'things:index', 'index' );
				//
				//$myAcl->allow( 'guest', 'things:view', array( 'viewall', 'viewone', 'move', 'search2', 'clear', 'getmain' ) );
				
			//	$myAcl->allow( 'guest', 'things:Picturemanager', array( 'next', 'previous', 'show' ) );
				
			//	$myAcl->allow( 'admin', 'things:Picturemanager', array( 'add', 'delete', 'setasmain' ) );
				
				$myAcl->allow( 'guest', 'technology:management', array('viewall', 'viewone', 'move', 'search2', 'clear', 'getmain' ) );
				
				$myAcl->allow( 'admin', 'technology:management', array( 'add', 'edit', 'delete' , 'addpict', 'deletepict', 'setasmain') );
				
				
				Class_myAcl::setInstance( $myAcl );
		}
		
	}
	
	
	protected function _initRouters(){
		
		
				$fc = Zend_Controller_Front::getInstance();
					
				$router = $fc->getRouter();
				
				$router->addRoute('tech', new Zend_Controller_Router_Route('technologie',
				
		                                     array(
		                                     'module' => 'technology',
		                                     'controller' => 'management',
		                                     'action' => 'viewall'))
		                              );
		                                     
		      
	}
	
	
	
	
	protected function _initAutoload() {
		
		
		//throw new Exception('hellow world z booddstrap Module');
		
		//Zend_Auth::getInstance()->setStorage( new Logx_library_AuthStorage() ); 
	}
	
}

?>