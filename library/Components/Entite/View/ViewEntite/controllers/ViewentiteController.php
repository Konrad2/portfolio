<?php

//Zend_Loader::loadClass ( 'controller' );
/**
 * Klasa abstrakcyjna odpowiedzialna za wywietlanie rekordów z bazy danych oraz ich paginacje.
 * Wymagania: model o nazwie modu�u+View dziedzicz�cy po abstract_viewModel.
 * Menu definiujemy domylnie w sekcji internalMenu w odpowiednim module.
 * @author Konrad
 * @abstract 
 * @package View

 *
 */

class ViewEntite_controllers_ViewentiteController extends Abstract_controllers_aViewController {
	
	
	private $__sectionMenuName = 'internalMenu';
	/** 
	 * @var array Co ma się wywietlić, pod jak nazwa.
	 */
	
	protected $__whatShowInOneAction = array();
	
	
	//protected $_sctiptPath = '../library/Components/Entite/Scripts/';
	//protected $_sctiptPath = '../library/Components/Entite/View/ViewEntite/views/scripts/';
		
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {			

		
		parent::__construct( $request,  $response, $invokeArgs);
				
	
		$this->_model = $this->createModel( 'ViewEntite_models_viewModel' );
		
										 
		$this->view->addScriptPath ( '../library/script/View/ViewEntite' );
	
		
		
		//$this->view->setScriptPath ( '../library/Components/Entite/Scripts/' );
	}
	
		
	/**
	 * Wy�wietla jeden wiersz z bazy danych. Może wyswietla dodatkowe informacje ze skojarzonych modul�w. Dodaj�c odpowiedni wpis do pliku connections.xml.
	 * Dodatkowo musimy miec jakis ViewentiteController w innym module. 
	 * Kontroler ten musi implemętować akcje wiewLabelAction. W akcji viewLabel definiujemy akcje w kturej generujemy widok.
	 * Widok ten zostanie wywietlony podczas renderowania widoku akcji viewone.
	 * Skojarzenie modułw dokonujemy poprzez wpisanie do pliku.
	 */
	
	public function viewoneAction() {
		
		
		$row = null;
		
		
		$this->view->keysAndLabels = $this->__whatShowInOneAction;		

		try {			
			
				$id = $this->_getId();				
					
						
				$this->_prepareMenuforViewOneAction( $id );
				
				
						$model  = $this->getModel();
						
						$row = $model->getOne( $id );

						
						$this->view->thing = $row;
						
						if ( $row === null )	{						
							
								throw new ViewEntite_library_Exceptions_BabId( "nie odnaleziono wiersza" );							
						}
		
						
						// dla moduów połczonych
						
						Zend_Registry::set ( 'row', $row );
						
						Zend_Registry::set ( 'id', $id );
		
						$this->view->id = $id;
						
					
				
			
			
		}

		catch( ViewEntite_library_Exceptions_BabId $ex ){
					
			/**
			 * @todo obsłurzyć 
			 */
						throw new Exception($ex);
						
		}
		catch ( Class_Exceptions_view $ex ) {
			
			
			$this->_flashMessenger->addMessage( 'Nie można otworzyć wybranego rekordu' );
			
			$ex->handle();
			
			$this->_forward( 'viewall' );		
				
		}
			
		return $row;
		
	}
	
	/**
	 * Jako klucz podajemy nazwę w bazie danych a jako wartość podajemy pod jakim nagłówkiem ma się wyświetlić.
	 * @param array $data
	 * @todo zamienić tak aby jako klucz podawano nagłówek pod którym ma się wyświetlić.
	 */
	protected function setWhatShowInOneAction(array $data){
		
		
		$this->__whatShowInOneAction = $data;
		
	}
	
	/**
	 * Tworzy menu wyświetlane w akcji viewoneAction. Menu jest przechowywane we właściwości widoku actionMenu jako Zend_Navigation.
	 */
	protected function _prepareMenuforViewOneAction( $id ) {
		
		$this->view->actionMenu = new Zend_Navigation();
		
		
		$this->view->navigation()->setAcl( Class_myAcl::getInstance() );
			
			
		$this->view->navigation()->setRole( Zend_Auth::getInstance()->getStorage()->read()->getRole() );			
	}
	
	/**
	 * Zwraca id encji.
	 * @return int
	 */
	protected function _getId(){
		
		
		$id = $this->_request->getIntParam ( 'id' );
                
//                $p = $this->_request->getParams ( );
//                var_dump($p);
//                die;
              
		if ( empty ( $id ) ) {
			
			throw new ViewEntite_library_Exceptions_BabId( "puste id" );			
		}
		
	
		
		return $id; 
	}
	
	/*
	protected function getModel(){
		
		
		$model = new ViewEntite_models_viewModel();
		
		$model->setTableName( $this->_tableName );
		
		return $model;
		/*
			$defaultModelName = $this->_request->getModuleName () . 'View';
			
			
			
			
			$what = $this->_request->getModuleName ();
			
			
			if (file_exists ( '../application/modules/' . $what . '/models/' . $this->modelName . '.php' )) {
				
				
					require_once ('../application/modules/' . $what . '/models/' . $this->modelName . '.php');
					
					$name = $this->modelName;
					
					$model = new $name ();
					
					$model->setTableName($this->_tableName);
				
				
			} else {
			
				
				throw new Exception ( 'nie odnaleziono modelu "' . $this->modelName . '.php"' );				
			
		}
*/
	
}
	