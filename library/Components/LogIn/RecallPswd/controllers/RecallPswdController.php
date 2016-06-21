<?php

/**
 * RecallPswdController
 * Zapewnia logowanie oraz wylogowywanie. Dane o urzytkowniku są trzymane w Zend_Auth_Storage.
 * @author Konrad
 * @version 1.1
 * @package RecallPswd
 * 
 */
	 			   
class  LogIn_RecallPswd_controllers_RecallPswdController  extends LogIn_Log_controllers_LogController {
	
	
	private $__lengtchPswd = 8;
	
	
	
	public function logAction() {
	
		
	//	$this->view->actionMenu = new Zend_Navigation( array ( new Zend_Navigation_Page_Mvc( array ( 'route' =>'recall', 'label' => 'Nie pamiętasz hasła', 'moodule'=>$this->_request->getModuleName(), 'controller'=>$this->_request->getControllerName(), 'action'=>'remember') )) );
		//$this->view->actionMenu = new Zend_Navigation( array ( new Zend_Navigation_Page_Uri( array ('label' => 'Nie pamiętasz hasła', 'moodule'=>$this->_request->getModuleName(), 'controller'=>$this->_request->getControllerName(), 'action'=>'remember') )) );

	
		parent::logAction();		
	}
	
	
	
	public function recallAction() {
		
	
		$form =   new RecallPswd_library_formRecallPswd();
		
				 
		if  ( ( $this->_request->isPost($_POST) ) &&( $form->isValid ($_POST) ) ) {					
				   
												
					$pswd = $this->__randPswd();			
					
					$this->__sendToUser( $pswd, $login );
					
					$this->__insertToDb ( $pswd );	
					
					
		} else {			
			
			
			if   ( $this->_request->isPost() )	;		
			
					
				//	$this->_helper->flashMessenger->addMessage('Nieprawidłowy Login');
			$this->view->form = $form;	
		}
		
			
	}
	
	
	/**
	 * Wstawia hasło do bazy danych.
	 * @param $pswd
	 * @param $login
	 */
	private function __insertToDb( $pswd ,$login ) {
		
	}
	
	/**
	 * wysyła hasło do urzydkownika.
	 * @param $pswd
	 * @param $login
	 */
	private function __sendToUser( $pswd , $addres ) {		
		

		 
      $config = array('ssl' => 'tls',
      
      					'login' => 'konwlo83',
      				
      					'password'=>'5PannaM5',
   
                     // 'port' => 587); // Optional port number supplied
                      'port' => 465); // Optional port number supplied
  
 
  //    $tr = new Zend_Mail_Transport_Smtp('smtp.dust.pl', $config);
     $tr = new Zend_Mail_Transport_Smtp('smtp.wp.pl', $config);

     
       Zend_Mail::setDefaultTransport($tr);
       
 
      $mail = new Zend_Mail();
 
      $mail->setBodyText('This is the text of the mail.');

      $mail->setFrom('konwlo83@wp.pl', 'Some Sender');

      $mail->addTo('techniczny@nysart.pl', 'Some Recipient');

      $mail->setSubject('Hello world');
  
      $mail->send($tr);
		
      
	}
	
	/**
	 * Generuje losowe hasło.
	 * @param $pswd
	 */
	private function __randPswd(  ) {
		

 	 	$pswd = md5(time());
 	 
  		$pswd = substr( $pswd , 0 , $this->__lengtchPswd );

  		
  		return( $pswd );

	}
	
	
}

