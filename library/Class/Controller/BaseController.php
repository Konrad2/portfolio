<?php

/**
 * BaseController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

abstract class Class_Controller_BaseController extends Zend_Controller_Action{

	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){
	 	
	 	
	 	
	 	//settype( $request, 'Class_Controller_Request_Abstract');
	 	
	 		parent::__construct( $request , $response, $invokeArgs);
	 		
	 
		
		 $this->view->controller = $this->_request->getControllerName();
		
		 $this->view->module = $this->_request->getModuleName();
		 
		$this->view->message = $this->_helper->getHelper('FlashMessenger')->getMessages();
	 }

	 
	 
	 
	 
	
	
	/**
	 * Tworzy zwraza obiekt typu Class_param. tworzy na podstawie klasy _request (moduleName...)  
	 */
	public function param()	{
		
		
		$param = new Class_param($this->_request);
		/*
		$param->setModule($this->_request->getModuleName());
		$param->setModule($this->_request->getControllerName());
		$param->setModule($this->_request->getActionName());
		*/
		
		return $param;
				
	}
	
	
	/**
	 * @return string �cie�ka do modu��w.
	 */
	protected function getModuleDirectory(){
		
		
		return '../application/modules';
		
	}
	
	
	/**
	 * @return string �cie�ka do modelu modu�u.
	 */
	protected function getModelDirectory(){
		

		return '../application/modules/'. $this->_request->getModuleName() .'/models' ;
	}

	
	/**
	 * @return string �cie�ka do katalogu z kontrolerami.
	 */
	protected function getControllerDirectory() {
		
		
		return '../application/modules/'. $this->_request->getModuleName() .'/controllers' ;
	}
	
	 
	 
	 
	 
	 
	 
}

