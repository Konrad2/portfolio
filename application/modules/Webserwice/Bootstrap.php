<?php
 		  
class Webserwice_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	
	protected function _initMenu() {		
	
		
		$menu = Zend_Registry::get('menu');
		
		
		
	$menu->addPage (new Zend_Navigation_Page_Mvc( array( 'label'=>'SOAP Client', 'module'=> 'Webserwice', 'controller'=>'Client', 'action' => 'index' ))) ;
		
		
		  
		Zend_Registry::set ('menu', $menu);		
		
	}
	
	
	
	protected function _initAcl(){
		
		
		
		$myAcl = Class_myAcl::getInstance();
		
		// Things module
 							
		if ( ! in_array ( 'Webserwice:Client' , $myAcl->getResources() ) ) {			
						
			
				$myAcl->add( new Zend_Acl_Resource( 'Webserwice:Client' ) );			
				
				$myAcl->allow( 'guest', 'Webserwice:Client', array('index' ) );
				
				Class_myAcl::setInstance( $myAcl );
		}
		
	}
	
	
}

?>