<?php

/** 
 * Modul zapisuje obrazki w sekcji public/images.
 * 
 * @author Konrad
 * @package Picture
 * 
 */
													   
//class Pict_controllers_ViewentitespictController extends ViewEntites_controllers_ViewentitiesController {
class Pict_controllers_ViewentitespictController extends Editadddelete_controllers_ManagementController {

	
	private $__pictBrosherName = 'thumbpicture.phtml';
	
	private $__mainName = 'main.jpg';
	
	
	private $__PatchToPictureStore = 'images/things/';
	
	private $__PatchToPictureDir = 'public/images';
	
	private $__PatchToIcon = 'icons';// $__PatchToPictureStore + __PatchToIcon = Patch to icon
	
	private $__PatchToBigPictures = '';
	
	private $__pictureDir;
	
	
	/**
	 * Nazwa kontrolera spełniajacego kontrakt pictureManager. Z załorzenia znajduje się w tym samym module.
	 * @var unknown_type
	 */
	private $__defaultPictManagerController = 'management';
	
	
	/**
	 * Nazwa kontrolera spełniajacego kontrakt Manager. Z załorzenia znajduje się w tym samym module.
	 * @var unknown_type
	 */
	private $__defaultManagerController = 'management';
	
	/**
	 * 
	 * @var Class_picture_Manager2;
	 */
	
	private $__manager;
	
	/**
	 * 
	 * @var Pict_library_Paths
	 */
	protected $_path; 
	
	
	
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {			

		
// $this->_sctiptPath =  '../library/Components/Entite/View/Pict/views/scripts/';
		
		
		parent::__construct( $request,  $response, $invokeArgs);	
		
		$this->view->addScriptPath( '../library/script/View/Pict/' );
		
	
	//	$this->__pictureDir = BASE_URL . '/public/images/' . $this->_request->getModuleName();	
		
	//	$this->__manager = new Pict_library_Manager( );
		
		$this->_path = new  Pict_library_Paths();
		
		$this->_path = $this->_setPaths( $this->_path ); 
		
		
		
		//$this->view->setScriptPath ( '../library/Components/Entite/View/Pict/views/scripts/' );
		
		
		$this->view->managerContract = $this->__defaultPictManagerController;
		
		//$this->view->layout()->setlayout('entitespict');
		

	}
	
	
	protected function _setPaths( $path ) {
		
		//if ( is_dir ( $path->getPatchToDirectory( $this->_getId() ) ) ){
		
		$path->setPathToDirectory( BASE_URL . $this->__PatchToPictureDir .'/' . $this->_request->getModuleName() );
		
		$path->setPathFromIndexToImages( 'images/' . $this->_request->getModuleName() );
		
		$path->setSubPathToIcons( $this->__PatchToIcon );
		
		$path->setMainPictureName( $this->__mainName );
		
		
		return $path;
	}
	/**
	 * Ustawia nazwę pliku zawierajcego przegldarę obrazków wywietlanych podczas akcji viewoneAction.
	 * @param string $name nazwa pliku.
	 */
	
	protected function setPictureBrowsher( $name ) {
		
		$this->__pictBrosherName = $name;
	}
	
	
	public function viewallAction() {
		
		
		$this->view->managerContract = $this->__defaultManagerController;
		
		
		//ViewEntites_controllers_ViewentitiesController::viewallAction();
		parent::viewallAction();
		
		$this->view->icons = array();
		
		foreach ( $this->view->paginator as $item ) {		

		
				$this->view->icons[ $item['id'] ] = $this->_path->getPathToMainIcon( $item['id'] ) ;
		
		}		
		
	}
	
	
	/**
	 * Asynchronicznie wysyła nazwę obrazka głównego. Ponajechaniu na ikonę w viewAllAction.
	 */
	
	public function getmainAction(){
		
		
		$id = $this->_request->getintparam('id');
		
		$this->_helper->layout()->disableLayout();
		
		$this->_helper->viewRenderer->setNoRender(true);
		
		$path = $this->_path->getPatchToMainPict($id);
		
		$data = array('pict'=>$path );
		
		$json = Zend_Json::encode($data);
		
		echo $json;		

	}
	
	
	public function viewoneAction() {
		
		
		$row = null;
		
		
		$id = $this->_request->getIntParam ( 'id' );
		
		
		if ( $id > 0 ) {
		
			
				$this->view->id = $id;

		
				$this->setPatchs( $id );

			
				$row = parent::viewoneAction();
	
				
				echo $this->view->render( $this->__pictBrosherName );
		
			
		} else {
			
				throw new Exception("niepoprawne id picture->viewOne() linia: 55");
		}
		
		return $row;
	}
	
	
	
	protected function _prepareMenuforViewOneAction( $id ) {
		
		
			parent::_prepareMenuforViewOneAction( $id );
	 
				
				
			$this->view->actionMenu->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module' => $this->_request->getModuleName(),
																	'controller'=> $this->_request->getControllerName() ,
																	'action'=>'addpict',
																	'label' => 'Dodaj obraz',	
																	'privilege'=>'addpict',
																	'resource'=>$this->_request->getModuleName().':'.$this->_request->getControllerName(),															
																	'params' => array( 'id' => $id ) 
															)  
													)
								);
	
	}
	
	
	private function setPatchs( $id ) {
				
		//viewall.phtml
		$mainPatch = $this->_path->getPatchToDirectory( $id );
		
		$this->view->pictureDir = $mainPatch;
		
		
		$this->view->main = $this->_path->getPatchToMainPict( $id );		
		
		$this->view->mainIcon =  $this->_path->getPathToMainIcon( $id );
		
		
		$this->view->bigPictures = array();
		
		$bigPict = $this->_path->getPathsToBigPicture( $id );
		
		$this->view->bigPictures = Class_file_file::putFileNameToKey( $bigPict );
		
		
		$this->view->icons = array();
		
		$icons = $this->_path->getPathToIcons( $id );		
	
		$this->view->icons =  Class_file_file::putFileNameToKey( $icons );

	}

	
	
	public  function setMainPictSize() {
		
		
		$patchToMain = $this->getPatchToMainPict( $this->__pictureDir );
				
		
		if ( file_exists( $patchToMain ) ) {			
	
				$size = getimagesize($patchToMain);
		
				$this->view->currentWidth = $size[0];
		 
				$this->view->currentHeight = $size[1];
			
		}
	}
	
}

?>