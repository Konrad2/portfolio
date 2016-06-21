<?php

class Packages_Products_controllers_ManagementController extends Pictmanage_controllers_PicturemanagerController {
	
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {
		
		
			parent::__construct( $request,  $response, $invokeArgs);
			
		
		$this->_setTableName('things');
		
		$this->setWhatShowInAllAction(array ('name') );
		
		$this->_pdoInternaceName = 'FormDb_Connect_Parent';
		
		//$this->createModel('Components_Entite_View_Search_models_View');
	}

	
	public function viewoneAction() {	
	
		
		$row = parent::viewoneAction();

		// Dolanczam usluge connections.
		$connector = new Components_Entite_Connections_library_Connector();
					
		
		$this->view->connecting = $connector->connect( $this->param(), $row );
		
		$this->render();
		
		//echo $this->view->render( 'connector.phtml' );
		return $row;
	}
	
	
	public function viewbuilsAction() {
		
		
			$searcherService = Components_System_library_System::service( 'iSearch' );				

			$navigation = $this->_getNavigation();
			
			$navigation->setAction('viewall');
			
			$searcherService->clear( $navigation );
			
			
			
			$this->_forward('viewall');
			//$this->redirect('viewall');
			  //$this->_helper->viewRenderer->setNoRender(true);
		
	}
	
	protected function createFormDb(){


		$form = new Packages_Products_library_forms_Product();

		$form->setTableName($this->_tableName);
		
		return $form;
	}
	
}

?>