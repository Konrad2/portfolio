<?php

class dw_ErrorController extends Zend_Controller_Action {

	
	public function errorAction(){
	
		$errors = $this->_getParam('error_handler');

 

        switch ($errors->type) {

            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:

            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:

            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                // 404 error -- controller or action not found

                $this->getResponse()

                     ->setRawHeader('HTTP/1.1 404 Not Found');

 					$this->view->message = "Podana strona nie istnieje";

                break;

            default:

                $this->view->message = "Wystpil nieoczekiwany bad";
 

                // ...

 

                // Log the exception:

                $exception = $errors->exception;

                $log = new Zend_Log(

                    new Zend_Log_Writer_Stream(

                        '../application/modules/error/tmp/applicationException.log'

                    )

                );

                $log->debug($exception->getMessage() . "\n" .

                            $exception->getTraceAsString());

                break;

        }
	}
	
  public function pageNotFoundAction() {
    //goes here if the page was not found
  }
 
  public function notAuthorizedAction() {
    //goes here if the user has no access to a page
  }
  
  
  public function diferentAction() {
  	
  	
  		if ( Zend_Registry::isRegistered( 'errorMessage' ) ) {
  			
  				$this->view->message = Zend_Registry::get( 'errorMessage' );
  		}
  }
}

?>