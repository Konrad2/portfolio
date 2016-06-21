<?php

class Pay_ViewController extends Editadddelete_controllers_ManagementController {

	protected $_tableName = 'pay';
	protected $_foreignKey = 'id_paying';
	
	
	public function init(){
		parent::init();
		
		$this->_setOverridingModule( new Zend_Navigation_Page_Mvc(array('module'=>'Sale','controller'=>'View', 'action'=>'viewone')));
		
		$this->setTitle('Sposób płatności');
	}
	
        
        public function changetypeAction(){    
		
		require_once '../application/modules/pay/models/payTypeChoose.php';
                $mPay = new payTypeChoose();
		//$courierElem = new courier_library_forms_elements_courierSelect('kurier');
		$courierElem  = Class_forms_myHandling::createSelect( $mPay->getNames('pay_type')->toArray(), $this->_foreignKey, false);
			
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
				$mOrder->changeCourier($row, $form->getValue('id_pay'));
			}	
		}
		
		
		$this->view->parentId = $this->_getParentid();
	
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

