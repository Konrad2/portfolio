<?php
Zend_Loader::loadClass('Zend_Controller_Action');

/**
 * 
 * Przetrzymuje 
 * @author Konrad
 * @package Controller
 */
class controllerOld extends Zend_Controller_Action
 {

 	/**
 	 * Kontroler ustawia layout. Podstawia do widoku bazowy adres Url. 
 	 * 
 	 */
	function init() 
  	{
  	     $this->view->baseUrl = $this->_request->getBaseUrl();	   
		 $this->_helper->layout->setLayout('layout');           
		/* if(Zend_Auth::getInstance()->hasIdentity())
		{
			$this->_helper->layout->setLayout('adminlayout');            
		}
		else
		{
			$this->_helper->layout->setLayout('adminlayout');            
			//$this->_helper->layout->setLayout('layout');            
		 }
		*/
	}
	
	/**
	 * Tworzy zwraza obiekt typu Class_param. tworzy na podstawie klasy _request (moduleName...)  
	 */
	public function param()
	{
		$param = new Class_param($this->_request);
		/*
		$param->setModule($this->_request->getModuleName());
		$param->setModule($this->_request->getControllerName());
		$param->setModule($this->_request->getActionName());
		*/
		
		return $param;		
	}
	
	/**
	 * @return string œcie¿ka do modu³ów.
	 */
	protected function getModuleDirectory(){
		return '../application/modules';
	}
	
	/**
	 * @return string œcie¿ka do modelu modu³u.
	 */
	protected function getModelDirectory(){
		
		return '../application/modules/'. $this->_request->getModuleName() .'/models' ;
	}
	
	/**
	 * @return string œcie¿ka do katalogu z kontrolerami.
	 */
	protected function getControllerDirectory(){
		
		return '../application/modules/'. $this->_request->getModuleName() .'/controllers' ;
	}
}
 ?>