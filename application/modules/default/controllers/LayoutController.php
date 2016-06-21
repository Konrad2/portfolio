<?php
class LayoutController extends Zend_Controller_Action
{
	
	function makemenuAction()
	{
		$myConfig = new Class_myConfig();
				
		$this->view->menu = 
		 $myConfig->outputLink( null , 'menu' , $this->_request->getBaseUrl() );	
	}
	
}
?>