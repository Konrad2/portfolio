<?php
			  
class IndexController extends abstract_Controllers_baseController {

	
	function indexAction()	{
		
	//	$this->_forward('viewall','management','Cms');
	
		
		$this->_redirect( 'Cms/Management/viewone/id/1');
	
	
		//what is main module
	}
	
	
	
}