<?php

/** 
 * Umożliwia wypisywanie tabeli z bazy danych.
 * Aby zmienić model urzyj metody _setModel. Aby stworzyć model urzyj createModel.
 * Tabela musi zawierać takie elementy jak:
 *  "id" autoincrement primaryKey,
 *  "labe"
 *  "title"
 *  Warzne Dokończyć dokumentację, opisać dobrze tabelęs !!!!!!!!!!!!!!
 *   
 * @author Konrad
 * @abstract 
 * @package View
 * 
 */

abstract class Abstract_controllers_aViewController extends Class_Controller_BaseController {

	/**
	 * nazwa tabeli
	 * @var unknown_type
	 */
	protected $_tableName;
	
	/**
	 * Nazwa klasy zapewniającej interfejs dostępu do danych w bazie np. viewModel, formDb, FormDbClient.
	 * 
	 * @var unknown_type
	 */
	protected $_pdoInternaceName;
	
	
	/**
	 * Abstract_models_viewModel
	 * @var unknown_type
	 */
	protected $_model;
	
	protected $_modelClassName ;
	
	protected $title;
	
//	protected $_sctiptPath;
	
	

	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {			

		//throw new exception("hellow");
				
		
			parent::__construct( $request,  $response, $invokeArgs);
			
			$this->view->addScriptPath('../library/script/Commonscripts/');
			
			$this->view->layout()->setlayout('entitespict');
			
			
			$this->__prepareMenuForAction();
			
			
				$this->view->module = $this->_request->getModuleName();
				
				$this->view->controller = $this->_request->getControllerName ();
				
				$this->view->action = $this->_request->getActionName ();
	}
	
	
	protected function __prepareMenuForAction(){
		
		
		$this->view->actionMenu = new Zend_Navigation();
		
		
		$this->view->navigation()->setAcl( Class_myAcl::getInstance() );
			
			
			$this->view->navigation()->setRole( Zend_Auth::getInstance()->getStorage()->read()->getRole() );	
			
	}
	
	/**
	 * Ustawia nagłówek wyswietlany w widoku.
	 * @param string $title
	 */
	
	public function setTitle( $title ) {
		
		$this->view->title = $title;
		$this->title = $title;
		
	}
	
	
	protected function _setTableName( $tableName ) {

		
			$this->_tableName = $tableName;
		
	}
	
	
 protected function _getMenu(){
	 	
	 	$nav = Class_Navigation_Navigation::createFromFile( $this->__patchToConfigWitchMenu, __sectionWithMenuInConfig );
	 	
	 	return $nav;
	 	
	 }
	 
	
	 /**
	  * Zwraca instancje klasy realizujjącej interfejs iViewModel.
	  */
	protected function getModel(){
		
		
		return $this->_model; 
		
		//$model = new $this->_modelName();
		
		//$model->setTableName( $this->_tableName );
		
		//return $model;
		
	}
	
	/**
	 * Tworzy instancje klasy realizującej interfejs iViewModel. Aby zmienić domyślny model wywołaj tą funkcję.
	 * @param unknown_type $name
	 */
	public function createModel( $name ) {
		
		
		$model = new $name();
		
		$model->setTableName( $this->_tableName );
		
		return $model;
	}
	
		
	/**
	 * Ustawia model słurzący 
	 * @param Abstract_models_viewModel $model
	 */
	protected function _setModel(  Abstract_models_viewModel $model ) {			
		
			$this->_model = $model;
	}
	
	
	/**
	 * Zwrava obiekt typu Zend_Navigation_Page_Mvc z złaciwociami module, controller, action ustawionymi według obecnych parametrów w request.
	 * @return Zend_Navigation_Page_Mvc
	 */
	
	protected function _getNavigation() {
		
		return new Zend_Navigation_Page_Mvc( array ( 'module'=> $this->_request->getModuleName(), 'Controller'=> $this->_request->getControllerName(), 'Action'=> $this->_request->getactionName() ) );
	}
	
	
}
		
		
	
	/**
	 * 
	 * wy�wietla komunikat zawarty w rejestrze jako message.
	 */
	/*
	protected function viewMessage() {
		
		
		if (Zend_Registry::isRegistered ( 'message' ) ) {
			
			
			$this->view->message = Zend_Registry::get ( 'message' );
			
		}
		
	}
	
	*/
	/**
	 * 
	 * @param string $section Nazwa dziecka w galezi dzewa xml.
	 * @param string @patch cie�ka do pliku konfiguracyjnego.
	 */
	/*
	
		
	
	}
	
	
	protected function getMenu( $patch,  $section ) {
		
	//	try {
			
				if ( file_exists ( $patch ) ) {
																																				  
					$page = Class_Navigation_Navigation::createFromFile( $patch, $section );
					
					return  $page  ;
						
				} else 
						
					return new Zend_Navigation_Page_Mvc();

	//	} catch(  Exception $ex ){
			
			echo 'Blad viewController->renderMenu';
			
	//	}
		
	
	}
	

	
	*/
	
	
?>