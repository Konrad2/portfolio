<?php
 		  
class Courier_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	
		protected function _initMenu() {

		$menuAdmin = Zend_Registry::get('menuAdmin');
		
		$menuAdmin->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module'=>'courier',
																	'controller'=>'View',
																	'action'=>'viewall',
																	'label' =>'Kurierzy',
																	'privilege'=>'viewall',
																	'resource'=>'courier:View',
																	
															)  
													)
								);
						
	
		Zend_Registry::set ('menuAdmin', $menuAdmin);
		
		}
	
	
	
}

?>