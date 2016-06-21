<?php
 		  
class Category_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	protected function _initRegistry() {
		
		
		$navigation = Zend_Registry::get('leftSide');
		
		$page = new Zend_Navigation_Page_Mvc( array( 'module'=>'Category', 'controller' => 'Management', 'action'=>'userinterface', 'label'=> 'Kategorie' ) ) ;
		
		$navigation->addPage( $page );
		
	}
	
	
	protected function _initMenu(){
		
	
	$menuAdmin = Zend_Registry::get('menuAdmin');
		
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'Category',
																	'controller'=>'Management',
																	'label' =>'Kategorie',
																	'action'=>'viewall',
																	'privilege'=>'viewall',
																	'resource'=>'Category:Management',
																	
															)  
													)
								);
		
			
				
	
		Zend_Registry::set ('menuAdmin', $menuAdmin);
		
	}	
	
	protected function _initAcl(){
		
		
		/*
		$myAcl = Class_myAcl::getInstance();
		
		// Things module
 
		if ( ! in_array ( 'Category:Management' , $myAcl->getResources() ) ) {
		
						
				$myAcl->add( new Zend_Acl_Resource( 'Category:Management' ) );
				
			
				$myAcl->allow( 'guest', 'Category:Management', array('viewall', 'viewone', 'move', 'userinterface', 'clear', 'addparam' ) );
				
				$myAcl->allow( 'admin', 'Category:Management', array( 'add', 'edit', 'delete') );
				
				
				Class_myAcl::setInstance( $myAcl );
		}
		*/
	}
	
	
	
}

?>