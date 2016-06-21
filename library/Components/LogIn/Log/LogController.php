<?php

/**
 * LogController
 * Zapewnia logowanie oraz wylogowywanie. Dane o urzytkowniku są trzymane w Zend_Auth_Storage.
 * @author Konrad
 * @version 1.1
 * @package Log
 */
	 			   
class Log_controllers_LogController extends Abstract_controllers_LogController  {
	
	/** 
	 * The default action - show the home page
	 */
	protected $_redirectTo = 'index/index';
	
	
	public function indexAction() {
		// TODO Auto-generated LogController::indexAction() default action
	}
	
	
	/**
	 * Z1.alowowuje
	 */
	public function logAction(){
	
	
		require_once '../library/Components/LogIn/Log/library/formLog.php';
				
		$form = new Log_library_formLog();
		
				 throw new Exception ();
		if  ( ( $this->_request->isPost($_POST) ) &&( $form->isValid ($_POST) ) ) {					
				   

				  //$myAuth = new Class_Auth_AdapterTable();
				   $myAuth = new Abstract_library_AdapterTable();
				   
	 		 		try{
	 		 			
	 		 						echo   md5($form->getValue('password'));
	    		   $authResultRow = $myAuth->loog( $form->getValue('login') , md5($form->getValue('password')) );	
	    		   
	    		
	    		   
	    		   if ( $authResultRow === null) {
	    		   	
	    		   		Zend_Registry::set('message','Nieprawidłowy Login lub hasło.');
	    		   		
	    		   			$this->_redirect( 'Log/log/log' );	
	    		   		//Throw new  Exception('logowanie nie powiodło się ');
	    		   }// else {
	    		   	
	    		   	
	    		   		 	$client = new Log_library_Client();
	    		  
	    		   		$client->setAuthObj( $authResultRow );
	    		   
	    		   	
	    		  		Zend_Auth::getInstance()->getStorage()->write( $client );
	    		  		
	    		  		//TODO Zend_Auth::getInstance()->getStorage()->setAuthObj( $authResultRow );
	    		  		
	    		   
	 		 		}
	 		 		catch( Exception $ex){
	 		 			
	 		 				Zend_Registry::set('message',$ex);
	 		 			
	 		 				$auth = Zend_Auth::getInstance();
						
							$storage = $auth->getStorage();
							
							$storage->clear();
							
							$auth->clearIdentity();
							
							$this->_redirect( $this->_request->getModuleName().'/'. $this->_request->getControllerName().'/'. $this->_request->getActionName() );		
	 		 		}
	    		   
	 		 				
					//$this->_redirect( $this->_redirectTo, array( "code"=>302) );
										
					//$this->_redirect( 'default/index/index' );						
						
												
		} else {
			
			
			if   ( $this->_request->isPost() )			
			
					//TODO Message
					Zend_Registry::set('message','Nieprawidłowy Login lub hasło.');
				
		}
		
		
		$this->view->form = $form;
		
	}

	
	
	/**
	 * Wylogowuje.
	 */
	
	public function outAction() {
		
		//throw new Exception('hellow');
		$auth = Zend_Auth::getInstance();
	
		$storage = $auth->getStorage();
		
		$storage->clear();
		
		$auth->clearIdentity();
		
		//$auth->getStorage() -> clear();
		

		//$session_role = new Zend_Session_Namespace('role');

		// $session_role->logOut
		//unset ( $session_role->role );
		
		
	//	$this->_helper->viewRenderer->setNoRender(true);
		
	//	$this->_redirect('default/index/index');
		$this->_redirect( $this->_redirectTo, array( "code"=>302) );
	}

	
	
}

