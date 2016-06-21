<?php

/**
 * LogController
 * Zapewnia logowanie oraz wylogowywanie. Dane o urzytkowniku są trzymane w Zend_Auth_Storage.
 * @author Konrad
 * @version 1.1
 * @package Log
 */
	 			   
class LogIn_Log_controllers_LogController extends Abstract_controllers_LogController  {
	
	
	
	private $__maxTryingLogCount = 5;
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
	
	
		//require_once '../library/Components/LogIn/Log/library/formLog.php';
		//require_once '../library/Components/LogIn/Log/library/formLogToken.php';
				
		//$form = new Log_library_formLog();
		$form =   new LogIn_Log_library_formLogToken();
		
			 
		if  ( ( $this->_request->isPost($_POST) ) &&( $form->isValid ($_POST) ) ) {					
			
			
		//if ( $this->__antyBruteForce() ) {
						
				  //$myAuth = new Class_Auth_AdapterTable();
				   $myAuth = new Abstract_library_AdapterTable();
				
	 		 		try{
	 		 				
			    		   $authResultRow = $myAuth->loog( $form->getValue('login') , $form->getValue('password') );	
			    		   
			    		 
			    		   if ( $authResultRow === null) { 		   
			    		   		
			    		   		$this->_helper->flashMessenger->addMessage( '<h3 class="error-message">Nie zalogowano .Nieprawidłowy Login lub hasło.</3>' );
			    		   		
			    		   			$this->_redirect( 'Log/log/log' );	
			    		   		
			    		   }
			    		   
			    		 

			    		   $this->_helper->flashMessenger->addMessage( 'Logowanie przebiegło prawidłowo' );
			    		  
			    		
			    		   		$client = new LogIn_Log_library_Client();		    	
			    		 
			    		   		$client->setAuthObj( $authResultRow );
			    		   		
			    		  
			    		   	
			    		  		Zend_Auth::getInstance()->getStorage()->write( $client );
			    		  		
			    		  		//TODO Zend_Auth::getInstance()->getStorage()->setAuthObj( $authResultRow );
			    		  		
			    		   
	 		 		}
	 		 		
	 		 		
	 		 		catch( Exception $ex){
	 		
	 		 				Zend_Registry::set('message',$ex->getMessage());
	 		 			
	 		 				$auth = Zend_Auth::getInstance();
						
							$storage = $auth->getStorage();
							
							$storage->clear();
							
							$auth->clearIdentity();
							
							$this->_redirect( $this->_request->getModuleName().'/'. $this->_request->getControllerName().'/'. $this->_request->getActionName() );
									
	 		 		}	    		   
	 		 	
					$this->_redirect( $this->_redirectTo, array( "code"=>302) );
						
			//} else {
			//	  throw new Exception('W trosce o Twoje bezpieczeństwo, masz tylko');
			//		$this->_helper->flashMessenger->addMessage('W trosce o Twoje bezpieczeństwo, masz tylko ' . $this->__maxTryingLogCount . ' prób logowania. Musisz poczekać 10 minut.');
				
			//}

			
		} else {			
			
			
			if   ( $this->_request->isPost() )			
			
					$this->_helper->flashMessenger->addMessage('zawiera niedozwolone znaki Nieprawidłowy Login lub hasło. ');
								
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

	
	
	private function __antyBruteForce() {
		
		
		$tryingCount = new Zend_Session_Namespace($_SERVER['DOCUMENT_ROOT'] . 'tryingLogCount');
				
		$tryingCount->setExpirationSeconds(10*60);
				
				if (isset( $tryingCount->count ))
						$tryingCount->count ++ ;
						
				else 
						
					$tryingCount->count = 1;

					
					
		return  ( $tryingCount->count < $this->__maxTryingLogCount) ;
		
	}
	
	
}

