<?php

/**
 * 
 * @author Konrad
 * @package Cart
 *
 */
class cart_indexController extends abstract_Controllers_baseController 
{	
	public function indexAction() {	
		
		
		//Class_myConfig::outputLink( $this->_request->getModuleName() , 'menu' , $this->_request->getBaseUrl() );		

		$this->_forward('viewcart','view');
		
	}
}