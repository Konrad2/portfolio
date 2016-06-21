<?php

/** 
 * 
 * Chcąc manipólować elementami formólarza nalerzy przeciąrzyć daną metodę.
 * Miejsce przekierowania można zmienić manipulując obiektem redirectAfterAddAction typu Zend_Navigation_Page_Mvc.
 * Zmianę rodzaju klasy FormDb można dokonać za pomocą metowy setFormDb. 
 * 
 * @author Konrad
 * @package Management
 * @abstract 
 * 
 */
abstract class Abstract_controllers_aManagementController extends Components_Entite_View_ViewRelated_controllers_RelatedController{ //abstract_Controllers_baseController{ 

	
	protected $section;	
	
	
	
	/**
	 * Nazwa tabeli w bazie danych.
	 * @var string
	 */
	//protected $_tableName;
	
	/**
	 * Kontroler odwołujie się do właściwości w celu przekierowania urzydkownika.  Przekierowanie następuje po zapisie danych. 
	 * @var Class_Redirector
	 */
	protected $_myRedirector;
	
	/**
	 * @var string �cie�ka do pliku z klasom dziedzicz�c� po formDb.
	 */
	
	//protected $__patchToFormDb;
	
	protected $_formDb = null;
	
    private $__patchToConfigWitchMenu = '../library/Components/Entite/config.xml';
    
	private $__sectionWithMenuInConfig = 'internalMenu';
	
	
	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){
	 	
	 	
	 	parent::__construct( $request, $response, $invokeArgs );
	 	
	 	
		$this->_redirectAfterAddAction = new Zend_Navigation_Page_Mvc();
		
	 
	//	$this->_myRedirector = new Class_Redirector();
	 	
	 	
		$this->view->layout()->setLayout('entitespict');
	 	
	 }
	 
	 /**
	  * Zwraca Abstract_library_redirector. 
	  * @return Abstract_library_redirector
	  */
	 public function getRedirector(){
	 	
	 	return $this->_redirector;
	 }
	 
	 /**
	  * Ustawia Abstract_library_redirector.
	  * @param Abstract_library_redirector $redirector
	  */
 	public function setRedirector( Abstract_library_redirector $redirector){
	 	
	 	$this->_redirector = $redirector;
	 }
	 
	 
	 
	protected function  _setTableName( $name ) {		
		
	 	$this->_tableName = $name;
	 	
	 }
	
	
	 
	 public function setPatchToConfig( $patch ){
	 	
	 }
	 
	 
	 public function setSectionWithMenuInConfig( $section ){
	 	
	 }
	 
	/**
	 * Metoda manipuluje, dokonuje zmian na obiekcie FormDb.
	 * Jest to miejsce w kturym można dokonać zmian na formularzu.
	 * Zwraca obiekt typu Zend_Form słurządzy do wywietlania urzytkownikowi. Chcąc manipólować elementami formólarza nalerzy przeciąrzyć daną metodę. Dzięki wywołaniu metody bazowen otrzymamy formę na kturej morzemy dokonywać zmian. Pamiętaj o zwróceniu ( return ) formy.  
	 */
	abstract protected function getFormDb();
	
	
	/**
	 * tworzy czysty obiekt typu FormDb
	 */
	abstract protected function createFormDb();
	/* {		
		
		
		$instance = $this->_formDb;
		
		
		if (  $instance === null  ) {
			
				switch ($this->_type){
				
					
					case 'oneToMany' :
							
						 $instance = new FormDb_Connect_oneToMany();
						 
						 break;

						 
					case 'manyToOne' : 
						
						$instance = new FormDb_Connect_manyToOne();
						
						break;
						
						
					case 'parent' : 
						
						$instance = new FormDb_Connect_Parent();
						
						break;
						
						
					case 'oneToOne' : 
						
						$instance = new FormDb_Connect_oneToOne();
						
						break;
						
					case '':
						break;
						
					 default: $instance = new FormDb_FormDb();
				}
				//require_once $this->__patchToFormDb;		
				
				//$po = $this->getFormDbName();
				
				//$instance = new Addanddelete_library_formDb();//$po();
				$instance = new FormDb_formDbParent();//$po();
				
				$instance->setTableName( $this->_tableName );
					
		} 
		
		return $instance;
		
	}
	*/
	
	
	//protected function setFormDb( FormDb_formDbParent $formDb ){
	protected function setFormDb( FormDb_aFormDb $formDb ){
		
		$this->_formDb = $formDb;
	}
		
	
	/**
	 * Przekierowuje w miejsce wskazane w  $_redirectAfterAddAction.
	 */
	protected function _myRedirect(){
		
		
		$this->_redirect ( $this->_getUrlAfter()
	          					
	          					//.'/id/1'
								
	          					, array('code' => 303 ));
	          					
	}
	
	
	

	/**
	 * Ustawia cierzké do pliku pliku z klasa FormDb.
	 */
	/*
	protected function setPatchToFormDb( $patchToFormDb ) {
		
			
		$this->__patchToFormDb = $patchToFormDb;
		
	}
	
	private function getFormDbName() {		
		
		
		return  basename ( $this->__patchToFormDb, ".php" );
		
	}
	*/
}

?>