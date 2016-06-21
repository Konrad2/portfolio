<?php

class Things_ManagementController extends Packages_Products_controllers_ManagementController {
	
	
	public function init() {
		
		$this->_setTableName('things');
		
		$this->setWhatShowInAllAction(array ('name') );
		
	}
	

	public function addAction() {
		
		
		$this->view->layout()->setlayout('layout');
		
		parent::addAction();		
	}
	
	
	public function viewoneAction() {
		
		
		$this->view->layout()->setlayout('layout');
		
		return parent::viewoneAction();		
	}
	
}

?>