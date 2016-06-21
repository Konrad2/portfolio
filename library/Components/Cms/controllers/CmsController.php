<?php
/**
 * Zarządzanie trecią stron www. Umożliwia generowanie menu. BBcode.
 * W bazie musi być jeden wiersz z id = 1 odpowiadający stronie głównej.
 * @author Konrad
 *@package Cms
 */
class Components_Cms_controllers_CmsController extends Editadddelete_controllers_ManagementController {
	
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {
		
		
			parent::__construct( $request,  $response, $invokeArgs);

			
			$this->setWhatShowInOneAction( array ('description'=> ''));	
		
			$this->view->layout()->setlayout('layout');
			
			$this->setWhatShowInAllAction( array ('name') );

				
	 	$this->view->addScriptPath ( '../library/Components/Cms/views/scripts/' );
	 	
		
	}
	
	
	


	public function deleteAction(){
		
		
		if (  $id = $this->_getId() == 1 ) {
			
			$this->_helper->flashMessenger->addMessage('<div class="message warning-message round-corners-container"><h4 >Nie można usunąć Strony głównej</h4></div>');
			
			$this->_redirect( $this->_request->getModuleName() . '/' . $this->_request->getControllerName() . '/viewone/id/' . $id  );
		}
		else 
				parent::deleteAction();
	}
	

	
	
	public function getFormDb(){
		
		$this->_pdoInternaceName = 'FormDb_Connect_Parent'; 
		$form = parent::getFormDb();
		
		$elems = $form->getElements();
		
		$elems['name']->setLabel('Nagłówek');
		
		unset($elems['model']);
		
		
		
		$elems['description']->setLabel('Treść');
		
		$elems['description']->setValidators( array ( new Class_Validators_TextBBCodePl() ) );		
		
		
		$form->setElements( $elems );
				
		$this->setFormDb( $form );
		
	 	return $form;
	}
	
}

?>