<?php

//class Components_Category_controllers_CategoryController extends Components_Entite_View_Search_controllers_SearchingController {
class Components_Category_controllers_CategoryController extends Editadddelete_controllers_ManagementController {

	/**
	 * 
	 * contrakt na rzecz którego dodajemy kategorie.
	 * @var Zend_Navigation_Page_Mvc
	 */
	
	protected $_contract;
	
	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
    {
    	parent::__construct($request, $response,  $invokeArgs);
    	
    	$this->_pdoInternaceName = 'FormDb_Connect_Client_Client';   
    	
    }
	
	/**
	 * dodaje kategorię.
	 */
	public function addparamAction() {
		
		
		$p = $this->_request->getAlNumParam('param', new Zend_Validate_Alnum() );	
		
		if  ( $p !== null ) { 
		
	
		
		$this->addCrioterion( $p );
		
			//$contract = Class_system::getContract( $this->param() );
		
			//TODO  System::resetPaginator();
			
			$this->_forward( 'viewall', $this->_contract->getController(), $this->_contract->getModule() );
		}	
	}
	
	
	public function userinterfaceAction() {
		
		
		$model = $this->getModel();
		
		$select = $model->select();
		
		$select->where('exist = 1');
		
		
		$entites = $model->fetchAll( $select );
		
		
		$this->view->entites = ($entites === null)? array() :  $entites;
		
	}
	
	
	private function addCrioterion( $value ) {
		
		
				$searcherService = Components_System_library_System::service( 'iSearch' );
				
				
				//$idCategory = $this->getModel()->getId( 'name', $value );
				
				$searcherService->clear( $this->_contract );
				
				$searcherService->add( 'id_category', $value, $this->_contract );
	} 
	
	
	/**
	 * usuwa wszystkie kategorie.
	 */
	public function clearAction() {
		
		/*
		Class_system::clearCriterion();
		
		$contract = Class_system::getContract( $this->param() );
		*/
			$searcherService = Components_System_library_System::service( 'iSearch' );
				
				
				//$idCategory = $this->getModel()->getId( 'name', $value );
				
				$searcherService->clear( $this->_contract );
				
		$this->_forward( 'viewall', 'management', 'things' );
	
		
	}
	
	
	protected function _setContract( Zend_Navigation_Page_Mvc $contract ){
		
		
		$this->_contract = $contract;
	}
	
	protected function _getIdCategory( $name ){
		
	}
	
}

?>