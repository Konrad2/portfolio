<?php

/**
 * LogController
 * 
 * @author
 * @version 
 */

class Accounts_LogController extends abstract_Controllers_baseController  {
	
	/**
	 * The default action - show the home page
	 */
	
	public function indexAction() {
		// TODO Auto-generated LogController::indexAction() default action
	}
	
	
	
	public function logAction(){
	
		
		require_once '../application/modules/accounts/library/formLog.php';
		
		$form = new formLog();
		
				
		if  ( ( $this->_request->isPost($_POST) ) &&( $form->isValid ($_POST) ) ) {		
				
				
		//		   require_once '../application/modules/accounts/library/myAuth.php';
					 
				  // $myAuth = new myAuth();
				//   $myAuth = new Components_Log_library_myAuth();
				   $myAuth = Components_Log_library_myAuth::getInstance();
				   
				   
	 								
	    		   $authResultRow = $myAuth->loog( $form->getValue('login') , $form->getValue('password') );	
	 				 					 				
	 		 				
					$this->_redirect( 'default/index/index' );						
						
												
		} else {
			
			
			if   ( $this->_request->isPost() )			
			
			//TODO Message
				echo "Nie prawid³owy login b±dz chas³o";
				
		}
		
		
		$this->view->form = $form;
		
	}

	
	
	public function outAction() {
		
		
		$auth = Zend_Auth::getInstance();

		$auth->clearIdentity();
		
		//$auth->getStorage() -> clear();
		

		$session_role = new Zend_Session_Namespace('role');

		// $session_role->logOut
		unset ( $session_role->role );
		
		
	//	$this->_helper->viewRenderer->setNoRender(true);
		
		$this->_redirect('default/index/index');
		
	}
	
	
}

