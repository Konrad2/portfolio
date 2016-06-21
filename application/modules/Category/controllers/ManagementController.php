<?php
				 
class Category_ManagementController extends Components_Category_controllers_CategoryController {

	
	public function init() {
		
		
		$this->_tableName = 'category';
		
		$this->_contract = new Zend_Navigation_Page_Mvc( array ( 'module'=>'things' ,'controller'=>'management', 'action'=>'viewall' ) );
		
		$this->setWhatShowInAllAction( array( 'name' ) );
		
		$this->_setContract( new Zend_Navigation_Page_Mvc ( array ('module' => 'things', 'controller' => 'management', 'action' => 'viewall' ) ) );
		
	}


	protected function createFormDb(){

		require_once "../application/modules/Category/library/forms/Category.php";
		$form = new Category_library_forms_Category();

		$form->setTableName($this->_tableName);
		
		return $form;
	}
	
}