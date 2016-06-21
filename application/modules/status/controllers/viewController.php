<?php
//ToDo - sprawdzanie poprawno¶ci id wiersza
class Status_viewController extends abstract_Controllers_viewController {
	
	public function init(){
		
		parent::init();
		$this->title = 'Status zamówienia';
	}
	
	public function viewlabelAction()
	{
		$system = new Class_system();
		$patch = $system->patchToModule();
		$patch .= '/status/views/scripts';
		$this->view->setScriptPath($patch);
		
		$row = Zend_Registry::get('row');

		require_once '../application/modules/status/library/changeStatusForm.php';
		$form = new changeStatusForm();		

		$form->setId($row->id);

		$form->setSelectValue($row->id_status);

		$form->setAction($this->_request->getBaseUrl().'/status/admin/change');

		$this->view->form =  $form;
	}
}

?>