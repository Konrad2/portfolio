<?php
 		  
class Cart_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	protected function _initRegistry() {
		
		
		$navigation = Zend_Registry::get('leftSide');
		
		
		$page = new Zend_Navigation_Page_Mvc( array( 'module'=>'Cart', 'controller' => 'View', 'action'=>'userinterface', 'label'=> 'Koszyk' ) ) ;
		
		$navigation->addPage( $page );
		
	}
	

	
	
		/*
	protected function _initAcl() {
		
	
		
		$myAcl = Class_myAcl::getInstance();
		

		if ( ! in_array ( 'Cart:Management' , $myAcl->getResources() ) ) {
		
						
				$myAcl->add( new Zend_Acl_Resource( 'Cart:Management' ) );
				
				$myAcl->add( new Zend_Acl_Resource( 'Cart:Cart' ) );
				
				$myAcl->add( new Zend_Acl_Resource( 'Cart:View' ) );
				
										
				$myAcl->allow( 'guest', 'Cart:Management', array('viewall', 'addparam', 'viewone', 'move', 'userinterface', 'clear', 'addparam' ) );
				
				$myAcl->allow( 'guest', 'Cart:Cart', array( 'addproduct','delete','tocashdesk','clear' ) );
				
				$myAcl->allow( 'guest', 'Cart:View', array( 'viewcart' ) );
				
				$myAcl->allow( 'admin', 'Cart:Management', array( 'add', 'edit', 'delete') );
				
				
				Class_myAcl::setInstance( $myAcl );
		}
	
	}
		*/	
	
	
	protected function _initMenu(){
	/*	
	
	$menuAdmin = Zend_Registry::get('menuAdmin');
		
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'Cart',
																	'controller'=>'Management',
																	'label' =>'Koszyk',
																	'action'=>'viewall',
																	'privilege'=>'viewall',
																		'resource'=>'Cart:Management',
																	
															)  
													)
								);

								
								
		Zend_Registry::set ('menuAdmin', $menuAdmin);
		*/
	}	
	

	
	
	
}

?>