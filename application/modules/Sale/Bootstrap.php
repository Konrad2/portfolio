<?php
 		  
class Sale_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	protected function _initRegistry() {	
		
	}
	
	
	protected function _initMenu() {
		
	
	$menuAdmin = Zend_Registry::get('menuAdmin');
		
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'Sale',
																	'controller'=>'View',
																	'label' =>'Sprzedaz',
																	'action'=>'viewall',
																	'privilege'=>'viewall',
																		'resource'=>'Sale:View',
																	
															)  
													)
								);

						
		Zend_Registry::set ('menuAdmin', $menuAdmin);
		
	}

	
	/*
	protected function _initAcl(){
		
		
		
		$myAcl = Class_myAcl::getInstance();
		
		// Things module
 
		if ( ! in_array ( 'Sale:View' , $myAcl->getResources() ) ) {
		
						
				
				$myAcl->add( new Zend_Acl_Resource( 'Sale:Transaction' ) );
				
				$myAcl->add( new Zend_Acl_Resource( 'Sale:Management' ) );
				
				$myAcl->add( new Zend_Acl_Resource( 'Sale:View' ) );
				
			
				$myAcl->allow( 'guest', 'Sale:Transaction', array('order', 'step1' ) );
				
				
				$myAcl->allow( 'admin', 'Sale:View', array( 'viewall','move','viewone','one2') );
				
				$myAcl->allow( 'admin', 'Sale:Management', array( 'add', 'edit', 'delete','viewall') );
				
				
				Class_myAcl::setInstance( $myAcl );
		}		
	}	
	*/
}

