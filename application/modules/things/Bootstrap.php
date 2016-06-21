<?php
 		  
class Things_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	
	protected function _initMenu() {		
	
		
		$menu = Zend_Registry::get('menu');
		
		
		
	$menu->addPage (new Zend_Navigation_Page_Mvc( array( 'label'=>'Produkty', 'module'=> 'things', 'controller'=>'management', 'action' => 'viewall', 'route' => 'default'  ))) ;
	//$menu->addPage (new Zend_Navigation_Page_Mvc( array( 'label'=>'Budynki', 'module'=> 'things', 'controller'=>'management', 'action' => 'viewbuils' ))) ;
		
		
		  
		Zend_Registry::set ('menu', $menu);
		
		
		
		$menuAdmin = Zend_Registry::get('menuAdmin');		
		
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 'label'=>'Dodaj budynek', 'module'=> 'things', 'controller'=>'management', 'action' => 'add', 'route' => 'default'  ) ));
		
		Zend_Registry::set ('menuAdmin', $menuAdmin);
		
	}
	
	
	protected function _initStyle() {
		
			 $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
			 
	            'ViewRenderer'
	        );
	        
			//$viewRenderer->view->HeadLink()->appendStylesheet('/public/styles/things.css');		
	}
	

/*	
	protected function _initAcl(){
		
		
		
		$myAcl = Class_myAcl::getInstance();
		
		// Things module
 							
		if ( ! in_array ( 'things:management' , $myAcl->getResources() ) ) {			
						
			
				$myAcl->add( new Zend_Acl_Resource( 'things:management' ) );			
				
				$myAcl->allow( 'guest', 'things:management', array('viewall', 'viewbuils', 'viewone', 'move', 'search2', 'clear', 'getmain' ) );
				
				$myAcl->allow( 'admin', 'things:management', array( 'add', 'edit', 'delete' , 'addpict', 'deletepict', 'setasmain') );
				
				
				Class_myAcl::setInstance( $myAcl );
		}
		
	}
	*/
	
	protected function _initRouters(){
		
		
				$fc = Zend_Controller_Front::getInstance();
					
				$router = $fc->getRouter();
				
				$router->addRoute('things', new Zend_Controller_Router_Route('budynki',
				
		                                     array(
		                                     'module' => 'things',
		                                     'controller' => 'management',
		                                     'action' => 'viewall'))
		                              );
				
			
	}
	
	
	protected function _initAutoload() {
		
	}
	
}

?>