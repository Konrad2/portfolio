<?php

class Index_IndexController extends Abstract_controllers_aViewController {
	
	public function init(){
		
		parent::init();
		
	//$this->view->addScriptPath('../application/modules/index/views');
		
	}
	
	public function indexAction(){
		
	}
	
	
	public function newAction(){
		
	}
	
	
	public function aboutAction(){
		
			$this->view->layout()->setlayout('layout');
	}
	
	
	public function oferAction(){
		
	}
	
	
	public function referenceAction(){
		
	}
	
	public function contactAction(){
		
	}

	
public function nysartAction() {
		
	
		//$this->_helper->redirector->gotoUrl('www.nysart.pl');

		$this->_redirect('nysart.pl');
		//$this->_forward('nysart.pl');
		
		$this->exit();
		
	}
}

?>