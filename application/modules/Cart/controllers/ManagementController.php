<?php
				 
class Cart_ManagementController extends Components_Category_controllers_CategoryController {

	
	public function init() {
		
		
		$this->_tableName = 'category';
		
		$this->_contract = new Zend_Navigation_Page_Mvc( array ( 'module'=>'things' ,'controller'=>'management', 'action'=>'viewall' ) );
		
		$this->setWhatShowInAllAction( array( 'name' ) );
		
		$this->_setContract( new Zend_Navigation_Page_Mvc ( array ('module' => 'things', 'controller' => 'management', 'action' => 'viewall' ) ) );
		
	}
	
	

	public function userinterfaceAction() {
		
		
		if (!$this->cart->_empty())	{
			
			
			$ids = $this->cart->get_ids();
		
			$this->view->things =	$this->things->getLabel($ids);
			
			$this->view->sum = 0;
								
			$this->view->finalize = $this->view->url( array('module'=>$this->_request->getModuleName(),'controller'=>'transaction','action'=>'order') );
			
			
		} else {			
			
			$this->view->empty = true;
			
		}
		

		$this->view->finalize = true;		
		
	}
}

?>