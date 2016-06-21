<?php
/**
 * Umożliwia połączenie z widokiem innego modułu. Łączenie modułów odbywa
 * się poprzez wpis do pliku connections.xml. W module podłanczany wywoływana
 * jest akcja viewlabelAction. Należy ustawić nazwę tabeli oraz
 * @package Related
 * @author Konrad
 * @version 1.0
 * @updated 21-gru-2012 18:58:29
 */
class Components_Entite_View_ViewRelated_controllers_RelatedController extends Components_Entite_View_Search_controllers_SearchingController implements ViewRelated_library_iRelated {

	
	/**
	 * Dane nadrydnego modulu.
	 * @var Zend_Navigation
	 */
	
	private $__overridingModule;
	protected $_idOverriding;
	
	 protected $_modelClassName = 'Components_Entite_View_ViewRelated_models_RelatedModel';
	 
	/**
	 * W przypadku gdy wymakany jest klucz obcy można go tu zdefiniować.
	 * @var string
	 */
	protected $_foreignKey;
	//TODO private $foreignKey
	/**
	 * @var string Adres do jakiego ma prowadzi� link wu�wietlony z viewlabel
	 * 
	 */
	
	protected $link;	
	
	/**
	 * Zmienna urzywana przez akcje viewlabel.
	 * Tytuł jaki ma się wywietlać w widoku.
	 * @var string 
	 * 
	 */
	
//	/protected $title;
	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){

	 	
	 	parent::__construct($request, $response, $invokeArgs);
	 	
	 		//$this->__overridingModule = new Zend_Navigation_Page_Mvc(); 
	 
	 }
	
	 
	 public function viewoneAction(){
	 	 	
	 	$row = parent::viewoneAction(); 	
	 		
		$system = new Class_system ();
		$this->view->mod = $system->getConnections ( $this->param () );
		
		
		Components_System_library_System::service('iRelated')->setRelatedParent( $this->_getNavigation() , $row);
		
		return $row;
	 }
	 
	 
	
	/**
	 * Kojarzy moduł z akcją innego (nadrzędnego) modułu wskazanego w Zend_Navigation_Page_Mvc.
	 * @param string $name
	 */
	 
	protected function _setOverridingModule ( Zend_Navigation_Page_Mvc $module ) {
		

		$this->__overridingModule = $module;
	}
	
	
	/**
	 * Zwraca Zend_Navigation_Page_Mvc nadrzędengo modółu(do któreko podłączony jest moduł).
	 * @return string 
	 */
	protected function _getOverridingModule() {
		
		
			return $this->__overridingModule;
		
	}
	
	/**
	 * Aby zdefiniować nazwy kolumn jakie maj� si� pojawi� nalerzy nadpisa� metod�  modułu view customCol, kt�ra zwruci nam tablic� zawieraj�c� nazwy interesuj�cych nas kolumn.
	 * Wywietla informacje odno�nie rekordu kturego id zosta� przes�any jako parametr.
	 * Akcja  ta mo�e by� po��czona z viewoneAction.
	 * W tej wersji jeden view label z jednego kontrolera mo�e być po��czony tylko z jedn a viewOne. 
	 * Aby przed wywietlonymi infotmacjami pojawić si jaki� tytu� nalerzy w metodzie init wprowadzi� tytu� do atrybutu title np.: public function init(){ $this->title = 'Kurier'; parent::init();}
	 * Pami�taj o wywo�aniy metody init w pom�cie przes�aniania jej.
	 * 
	 * @todo Mo�liwosc dodawania.
	 */	
	
	public function viewlabelAction() {
		
		
	
		$relatedService = new Components_Entite_View_ViewRelated_library_Service();
		
	
		$row = $relatedService->getRelatedParent( $this->_getOverridingModule() );
		
		//$row = $this-> getRelatedParent( 'fafew');
	
		$nrow = $this->getModel()->getCustom ( $row );	
			
		$this->view->row = $nrow;		

		$this->view->link = $this->_request->getModuleName () . '/' . $this->_request->getControllerName () . '/viewone/id/' . $nrow->id;
			
		$this->view->title = $this->title;	
	
	}
	
	public function getcoourieraddressAction(){
		//pprzerobić overriding z url
		
		//$row = $relatedService->getRelatedParent( $this->_request->getParam('overriding') );
	
	}
	
	
	protected function getModel(){
		
		$model = parent::getModel();
		$model->setForeignKey( $this->_foreignKey );
		return $model;
	}
	
	
	/*
		protected function _getId(){
		
			$parentRow = $this->_getParent();
			// System::getContract('iRelated')->getparentParentRow();
			
			$id =  $parentRow[$this->_foreignKey];
			// to w systemiethrow expection ('nie został zarejestrowany rodzić');
		}
	*/
	/*
	 * Zwraca rekord z nadrzędnego modułu z kturym zkojarzony jest akcja.
	 * @return Zend_Db_Table_Row
	
	protected function _getParent() {
		
		
			$relatedService =  Components_System_library_System::service( 'iRelated' );
			
			try {
				
				$row =  $relatedService->getRelatedParent( $this->_getOverridingModule() ); 
				
				return $row;
				
			}
			catch (Exception $Ex){
				
				echo $Ex->getMessage();
						
			}
			
			
	}
	 */
	
	/**
	 * Przekierowuje urzydkownika po wstawieniu wiersza do akcji viewone rodzica.  
	 * 
	 * @param array $params
	 */
	
	protected function _redirectAfrerAdd( array $params = null ){
		
					
			parent::_redirectAfrerAdd(null);
		
	}
	
	
	
	/**
	 * Zwraca id z nadrzędnego modułu.
	 * @return int
	 */
	
	protected function _getParentId() {
		
			return $this->_getParent()->id;
						
	}
	
	protected function _getParent(){
		
		return  Components_System_library_System::service('iRelated')->getRelatedParent($this->_getOverridingModule());
			
	}
	
	
	
	/**
	 * Wyłącza tworzenie menu (jest już wywołane przez rodzica).
	 */


/**
	 * Tworzy menu wyświetlane w akcji viewallAction. Menu jest przechowywane we właściwości widoku actionMenu jako Zend_Navigation.
	 */
	 
	/*protected function  _prepareMenuforViewAllAction() {
		
		$this->view->menuAction = new Zend_Navigation();
		
		parent::_prepareMenuforViewAllAction();			
		
	}
	*/
	
}

