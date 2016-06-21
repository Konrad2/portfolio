<?php
class Category_ViewController extends abstract_Controllers_viewController {

	public function init() {
	
		parent::init();
		
	}
	
	
	public function viewallAction() {
		
		$this->renderMenu ();
		
		$this->view->setScriptPath ( '../application/modules/category/views/scripts' );
		
		$this->model->getSubcategories ( 0 );
	}
	
	public function viewinterfaceAction() {
		
	//	$this->_helper->viewRenderer->setNoRender ( true );
	
	$this->_helper->viewRenderer->setNoRender();
//	$this->_helper->layout()->disableLayout();
	
	//$this->_helper->resetHelpers();
	
	
	
		echo '<ul>';
		//echo '<li> <a href="' . $this->_request->getBaseUrl () . '/category/search/clear">Wszystkie</a> </li>';
		echo '<li> <a href="' . $this->_request->getBaseUrl () . '/things/view/clear">Wszystkie</a> </li>';
		$this->model->getSubcategories ( 0 );
		echo '</ul>';
		
	}
}
?>