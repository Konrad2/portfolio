<?php
 		  
class Comments_Bootstrap extends Zend_Application_Module_Bootstrap {
	

	protected function _initStyle() {
		
			 $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
	            'ViewRenderer'
	        );
	        
			$viewRenderer->view->HeadLink()->appendStylesheet(BASE_URL.'public/styles/comments.css');
		
	}
	
	protected function _initAcl() {
		
		
		$myAcl = Class_myAcl::getInstance();
		
		
		if ( ! in_array ( 'Comments:management' , $myAcl->getResources() ) ) {
		
						
				$myAcl->add( new Zend_Acl_Resource( 'Comments:management' ) );
				
		
		
				$myAcl->allow( 'guest', 'Comments:management', array('viewall', 'viewone','add') );
				
				$myAcl->allow( 'admin', 'Comments:management', array(  'delete','edit') );
				
				
				Class_myAcl::setInstance( $myAcl );
		}
		
	}
	
	
	protected function _initAutoload() {
		
		
		//throw new Exception('hellow world z booddstrap Module');
		
		//Zend_Auth::getInstance()->setStorage( new Logx_library_AuthStorage() ); 
	}
	
}

?>