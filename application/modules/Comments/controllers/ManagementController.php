<?php

//class Comments_ManagementController extends ViewRelated_controllers_relatedController {
class Comments_ManagementController extends Components_Comments_controllers_CommentsController {
		
		 	
	public function init() {
		
		
			$this->_tableName = 'comments';
	
			$this->_setOverridingModule ( new Zend_Navigation_Page_Mvc ( array ( 'module' => 'things', 'controller'=> 'management', 'action' => 'viewone') ) );
			
			
			$this->_setRedirectAfterAdd( new Zend_Navigation_Page_Mvc( array ( 
											'module'=>'things',
											 'controller'=>'management',
											 'action'=> 'viewall',
											 'params'=>array(
											 			'id'=>$this->_getParentId()
														)
											 ) ) );
	}
	
	
	

	public function addAction() {
		
		
		$this->_setRedirectAfterAdd( new Zend_Navigation_Page_Mvc( array ( 
											'module'=>'things',
											 'controller'=>'management',
											 'action'=> 'viewall',
											 'params'=>array(
											 			'id'=>$this->_getParentId()
														)
											 ) ) );
		
		parent::addAction();
		
	}
	
	
	

	
	
	protected function _prepareMenuforViewOneAction( $id ) {
		
	
	Throw new exception($this->_request->getModuleName());
	}
	
}

?>