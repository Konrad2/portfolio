<?php

//Zend_Loader::loadClass ( 'controller' );
/**
 * Klasa abstrakcyjna odpowiedzialna za wy�wietlanie rekord�w z bazy danych oraz ich paginacje.
 * Wymagania: model o nazwie modu�u+View dziedzicz�cy po abstract_viewModel.
 * @author Konrad
 * @abstract 
 * @package View
 *
 */

class abstract_Controllers_viewController extends abstract_Controllers_baseController // implements iView
{
	
	/**
	 * @var string Adres do jakiego ma prowadzi� link wu�wietlony z viewlabel.
	 */
	
	protected $link;	
	
	/**
	 * Zmienna urzywana przez akcje viewlabel.
	 * @var string Tytu� jaki ma si� wy�wietla� w sojarzonym module.
	 */
	
	protected $title;
	
	/**
	 * @var string Nazwa modelu implementuj�cego interfejs iView. Domy�lnie nazwa_modu�u+View.
	 */
	
	protected $modelName;	
	
	/**
	 * instancja klasy modelu implem�tuj�cej funkcje klasy abstract_viewModel.
	 * @var unknown_type
	 */
	
	protected $model;	
	
	/**
	 * Inicjuje modu� tworz�c instancje klasy modelu. Klasa modelu powinna nazywa� si� tak samo jak nazwa klasy z dodatkiem "View".
	 * Po nadpisaniu obowi�zkowo wywo�a� parent::init();
	 * Podajemy dane do viewlabel:
	 * 
	 */	
	
	protected $_flashMessenger;
	
	
	/**
	 * Tablica zawiera co ma byc wyswietlone i pod jaka nazw, podczas akcji viewone. Jeli jest null w�wczas wszystko.
	 * Domylnie null.
	 * @var array
	 */
	protected $_whatShow_One = null;
		
	protected $_whatShow_all = null;
	
	public function init() {		
		
		
		parent::init ();
		
		//$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
		
		$this->modelName = $this->_request->getModuleName () . 'View';
		
		$this->view->setScriptPath ( '../library/script' );
		
		$what = $this->_request->getModuleName ();
		
		
		if ( file_exists ( '../application/modules/' . $what . '/models/' . $this->modelName . '.php' ) ) {
			
			
			require_once ('../application/modules/' . $what . '/models/' . $this->modelName . '.php');
			
			$name = $this->modelName;
			
			$this->model = new $name ();
			
		} else {
		
			throw new Exception ( 'nie znaleziono pliku ' . $this->modelName . '.php' );
			
		}
		
		
	//	$this->view->placeholder('menu')->set( $this->renderMenu('../application/modules/' . $this->_request->getModuleName() . '/config.xml', $this->_request->getActionName() ), 'internalMenu' );
	
		
	}
	
	
	
	/**
	 * 
	 * wy�wietla komunikat zawarty w rejestrze jako message.
	 */
	
	protected function viewMessage() {
		
		
		if (Zend_Registry::isRegistered ( 'message' ) ) {
			
			
			$this->view->message = Zend_Registry::get ( 'message' );
			
		}
		
	}
	
	
	/**
	 * 
	 * @param string $section Nazwa dziecka w galezi dzewa xml.
	 * @param string @patch cie�ka do pliku konfiguracyjnego.
	 */
	
	protected function renderMenu( $patch = null,  $section = null ) {
		
		try {
			
				if ( file_exists ( $patch ) ) {
																																				  
					$page = Class_Navigation_Navigation::createFromFile( $patch, $section );
				
				return $this->view->navigation()->menu()->render( $page ) ;
			//	return $page ;
						
			}

		} catch(  Exception $ex ){
			
			echo 'Blad viewController->renderMenu';
			
		}
		
	
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
	

	
	
	/**
	 * Wy�wietla jeden wiersz z bazy danych. Mo�e wyswietla dodatkowe informacje ze skojarzonych modul�w. Dodaj�c odpowiedni wpis do pliku connections.xml.
	 * Dodatkowo musimy miec jakis viewController w innym module. 
	 * Kontroler ten musi implem�towa� akcje wiewLabelAction. W akcji viewLabel definiujemy akcje w kturej generujemy widok.
	 * Widok ten zostanie wywietlony podczas renderowania widoku akcji viewone.
	 * Skojarzenie mod��w dokonujemy poprzez wpisanie do pliku.
	 */
	
	public function viewoneAction() {	
		
		
		$this->view->whatShow = $this->_whatShow_One;
		
		
		$system = new Class_system ();

		$this->view->mod = $system->getConnections ( $this->param () );
		
		$id = $this->_request->getIntParam ( 'id' );
		

		try{		
			
			
			if ( ! empty ( $id ) ) {
	
				
				$row = $this->model->getOne( $id );
				

				if ($row === null )	{
					
					
					throw new Class_Exceptions_view("Nie odnaleziono wiersza");
					
				}

				
				$this->view->thing = $row;

				
				Zend_Registry::set ( 'row', $row );
				
				Zend_Registry::set ( 'id', $id );

				$this->view->id = $id;
				
				
			} else	{
				
				
				throw new Exception('złe id');
				
			}
			
			
		}
		
		//catch (Exception $ex){
		catch ( Class_Exceptions_view $ex ){
			
			
			//$this->_flashMessenger->addMessage('Nie można otworzyć wybranego rekordu');
			$this->_helper->getHelper('FlashMessenger')->addMessage('Nie można otworzyć wybranego rekordu (id '.$id.').');
			$ex->handle();
			
			$this->_forward('viewall');		
				
		}
		
		
	}
		
	
	/**
	 * Akcja odpowiada za prawid�ow� paginacje.
	 */
	
	public function moveAction() {
		
		
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$g = new Zend_Session_Namespace ( 'paginator' . $this->_request->getModuleName () );
		
		$g->offset = $this->_request->getIntParam ( 'page' );
		
		
		$this->_redirect ( $this->_request->getModuleName () . '/View/viewall' );	
	
	}
	
	
public function viewallAction() {
		
		
		$this->view->whatShow = $this->_whatShow_all;
		
		
		//echo Zend_Auth::getInstance()->getStorage()->read();
			
		//$this->view->addHelperPath('../library/Class/Menu');
		
	//	$h = new Class_Menu_Helper();
		
	//	$h->setView( $this->view );
				
		
	//	$this->view->registerHelper(new Class_Menu_Helper(), 'Test');
		
		//$this->view->registerHelper ( 'MyMenuHelper', new Class_Menu_Helper() );
		 $this->renderMenu ();
		
		//if (Zend_Registry::isRegistered ( 'message' )) {
			//$this->view->message = Zend_Registry::get ( 'message' );
		//}

		//$this->view->message = $this->_flashMessenger->getMessages();

		//Do linku np. szczegóły
		$this->view->controler = $this->_request->getControllerName ();
		
		$this->view->action = 'viewone';

		$this->view->paginator = new Class_paginatorView ( $this->model->getSelect (), $this->_request->getModuleName () );
	}

	
}
	

	/*
	function __call($method, $args)
	{
		if ('Action' == substr($method, -6)) {

            return $this->_forward('badurl', 'Error');
        }

        
        throw new Exception('Niew��a��ciwa metoda"'
                            . $method
                            . '" called',
                            500);
	}
	*/
