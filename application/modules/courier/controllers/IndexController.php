<?php

/**
 * 
 * @author Konrad
 * @package Courier
 *
 */
class Courier_indexController extends abstract_Controllers_baseController 
{	
	public function indexAction()
	{	
		//abstract_menu::renderMenu( $this->_request->getModuleName() , 'menu' , $this->_request->getBaseUrl() );	
		//Class_myConfig::outputLink( $this->_request->getModuleName() , 'menu' , $this->_request->getBaseUrl() );		

		$this->_forward('viewall','view');
	}
}