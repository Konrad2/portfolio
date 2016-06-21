<?php
class Technology_ManagementController extends Packages_Products_controllers_ManagementController {
	
	
	public function init() {
		
		$this->_setTableName('technology');
		
		$this->setWhatShowInAllAction( array ('name') );	
		
		
	}		
	
	
	public function viewallAction(){
		
		
		$this->view->addScriptPath( '../application/modules/technology/views/scripts');
		
		parent::viewallAction();
	}
	
	
	public function viewoneAction(){
		
		
		$this->view->layout()->setlayout('layout');
		
		parent::viewoneAction();		
	}
	
	
	
	public function addAction(){
		
		
		$this->view->layout()->setlayout('layout');
		
		parent::addAction();		
	}
}
?>