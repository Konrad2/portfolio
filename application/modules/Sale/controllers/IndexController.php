<?php


/**
 * 
 * @author Konrad
 * @package Sale
 *
 */
class Sale_indexController extends abstract_Controllers_baseController 
{	

	function indexAction()
	{		
		$this->_forward('viewall','view');		
	}
}
