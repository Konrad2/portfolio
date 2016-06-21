<?php
									//Editadddelete_controllers_ManagementController
class courier_ViewController extends  Editadddelete_controllers_ManagementController {

	protected $_tableName = 'courier';
	protected $_foreignKey = 'id_courier';
	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){ 	
	 	
	 	parent::__construct($request, $response, $invokeArgs);
	 	
	 	$this->view->setScriptPath ( '../application/modules/courier/views/scripts' );
	 	
	 	$this->_setOverridingModule( new Zend_Navigation_Page_Mvc(array('module'=>'Sale','controller'=>'View', 'action'=>'viewone')));
		
		$this->setTitle('Kurier');
		
		$this->_redirectAfterEdit = new Zend_Navigation_Page_Mvc( array (
	 																		'module' => $this->_request->getModuleName(),
	 																		'controller' => $this->_request->getControllerName(),
	 																		'action'=> 'viewone'
	 																		)
	 																);		
	 }
	
	protected function createFormDb(){
		
		$formDb =  new courier_library_forms_Courier ();
		
		$formDb->setTableName($this->_tableName);
		return $formDb;
	}
	
	public function changecourierAction(){
		
		require_once '../application/modules/courier/models/courier.php';
    	$mCourier = new courier();
		//$courierElem = new courier_library_forms_elements_courierSelect('kurier');
		$courierElem  = Class_forms_myHandling::createSelect( $mCourier->getNames('courier_name')->toArray(),'id_courier', false);
			
		$form = new Zend_Form('form');
		
		$row = $this->_getParent();	

	
		
		$courierElem->setValue($row[$this->_foreignKey]);		
	
		$form->addElement($courierElem)
			->addElement( new Zend_Form_Element_Submit('Zmien') );
		$this->view->form = $form;
		
		if( $this->_request->isPost()){
			
			if ( $form->isValid($_POST)){
				require_once('../application/modules/Sale/models/sale.php');
				$mOrder = new sale();
				$mOrder->changeCourier($row, $form->getValue('id_courier'));
			}
		}
		
		
		$this->view->parentId = $this->_getParentid();
	}
	
	public function viewallAction(){

		$page = new Zend_Navigation_Page_Mvc(array(
		'action'     => 'add',
   		'controller' => 'addandedit',
   		'module'     => 'courier',
		'label'=>'Dodaj'		
		));
		
		$this->setWhatShowInAllAction(array('label'=>'add','module'=>'courier','controller'=>'addanddelete','action'=>'add'));
		 
		parent::viewallAction();
		
		$this->view->actionMenu->removePages();
		$this->view->actionMenu->addPage($page);
	}
	/*
 	public function viewlabelAction() {

 		$this->_setOverridingModule( new Zend_Navigation_Page_Mvc(array('module'=>'sale', 'controller'=>'View', 'action' => 'viewone' )));
	 	
	 		try {	 			
	 		
		 		 if ( $row = $this->_getParent() ) {
		 		
		 		 
				 		 $id = (int) $row->id;
				 		 	
				 		 
				 		 	if ( ! is_int ($id) || ($id <= 0 ) )
				 		 	
				 		 			throw new Class_Exceptions_BabIdException('id='.$id);
				 		 					 		 	
				 		 			
				 		 	$searcher = new Components_Entite_View_Search_library_OneCriterion();
				 		 		
				 		 	$nav = new Zend_Navigation_Page_Mvc( array( 'module'=>'Comments', 'controller'=>'management', 'action'=>'viewall') );
				 		 		
				 		 	$searcher->add( $this->_foreignKey, $id,  $nav);

			//	 		 	System::searcher()->addOneCriterion();
				 		 	
				 		 					 		 			
				 		  	$this->_helper->actionStack('viewall');
				 		
				 		//	$this->_helper->viewRenderer->setnorender(true);
				 			
				 			
		 		 } else {
		 		 	
		 		 		Throw new Exception ('Nie odnaleziono wierasz z nadrzędnego modułu');
		 		 }
	 			
	 			
	 		} catch ( Class_Exceptions_BabIdException $ex ) {
	 			
	 			
	 				echo 'Błąd Connections, niepoprawnie przekazane id rodzica. '. $ex->getMessage();
	 			
	 		}

	 		catch ( exception $ex ) {
	 			
	 			
	 				echo 'Wyswietlanie kuriera nie powiodło się z powodu: '. $ex->getMessage();
	 			
	 		}
	 		
	 
		
	 }
	 */
}

