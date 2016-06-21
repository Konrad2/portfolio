<?php

/** 
 * Realizuje interfejs viewallAction.
 * Komponent wyświetla wiersze z bazy danych. 
 * Chcąc manipulować wynikami wyświetlanych wyników ustaw odpoviedni Zend_Db_Selekt za pomocą metody _setSelect.
 * @author Konrad
 * @package View
 * 
 * 
 */
class ViewEntites_controllers_ViewentitiesController extends ViewEntite_controllers_ViewentiteController {

	
	protected $_whatShowInAllAction = array();
	
	private $__select;
	
	/**
	 * Przechowuje miejsca przekierowania po wskończeniu akcji addAction.
	 * @var Zend_Navigation_Page_Mvc
	 */
	
	protected $_redirectAfterAddAction;
	
	
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {
						

		
				parent::__construct( $request,  $response, $invokeArgs);		
	
		
				$this->_select = null;
				
				$this->view->addScriptPath( '../library/scripts/View/ViewEntites/' ) ;
		
				
	}
	
	/**
	 * ustawia selekt za pomocą kturego wyciągamy wiersze w akcji viewall. Można za pomocą tej metodu manipulować wynikami. np ustawić odpowiednie sortowanie.
	 * @param Zend_Db_Select $select
	 */
	protected function _setSelect(  $select){
		
		$this->__select = $select;
	}
	
	
	/**
	 * view all rows from db, from db. use model created in init metod. model must have name combine witch module name and 'View.php'
	 * model have to intcherit from ... 
	 * Aby wy�wietli� wybrane wiersze pod wybranymi nazwami nalerzy nada� odpowiednie wpisy w pliku config.xml modu�u.
	 * Aby zdefiniowa� kolumny oraz ich nazwy nalerzy stworzy� element <RowSetNames>.
	 */
	public function viewallAction() {
		
		
		
		 $this->_prepareMenuforViewAllAction();
		
				
		$this->view->keysAndLabels = $this->_whatShowInAllAction;
		
		
		 //$this->renderMenu('../application/modules/'.$this->_request->getModuleName().'/config.xml', 'menu' );		 
	

		//Do linku np. szczeg�y
		
		
		
		$this->view->action = 'viewone';
				
		
		//$paginator = new ViewEntites_library_PaginatorView (  new Zend_Paginator_Adapter_DbSelect( $this->getModel()->getSelect () ) );
		$paginator = new ViewEntites_library_PaginatorView (  new Zend_Paginator_Adapter_DbSelect( ViewEntite_controllers_ViewentiteController::getModel()->getSelect ( $this->__select ) ) );
		
                
               // var_dump($paginator);
		$paginator->initialize($this->_request->getModuleName ());
		//var_dump($this->__select);
		// var_dump(ViewEntite_controllers_ViewentiteController::getModel() );
		$this->view->paginator = $paginator;
		
		return $paginator;
		
	}
	
	
	
	
	protected function setWhatShowInAllAction(array $data) {
		
		
			if ( is_array( $data ) ) {
				
					$this->_whatShowInAllAction = $data;
					
			} else {
				
					throw new exception('nie przekazano tablicy do funkcji  ViewEntites_controllers_ViewentitiesController ->setWhatShowInAllAction');
			}
			
	}
	
	
	/**
	 * Tworzy menu wyświetlane w akcji viewallAction. Menu jest przechowywane we właściwości widoku actionMenu jako Zend_Navigation.
	 */
	protected function  _prepareMenuforViewAllAction()  {
		
		
	}
	
	protected function __prepareMenuForAction(){}
	
	
	public function moveAction() {
		
		
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$g = new Zend_Session_Namespace ( 'paginator' . $this->_request->getModuleName () );
		
		$g->offset = $this->_request->getIntParam ( 'page' );
		
               
		$this->_redirect ( $this->_request->getModuleName () . '/' . $this->_request->getControllerName() . '/viewall' );	
	
	}

	
}

