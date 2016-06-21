<?php
//TODO - filtrowanie poprawic
/** 
 * @author Konrad
 * 
 * @package Pictures
 * @package Management
 * @package Entite
 * Zapewnia zarzdzanie obrazkami. Dziki komponentowi można dodawac obrazki do rzeczy (entite,thing) wedlug podanego id. 
 * Ustawic obrazek jako etykiete lub go skasowac
 */

class Pictmanage_controllers_PicturemanagerController extends Pict_controllers_ViewentitespictController {
//class Pictmanage_controllers_PicturemanagerController extends Editadddelete_controllers_ManagementController {

	
	
	private $_pictureManager;
	
	protected $_uploadForm;
	
	
	
	private $__PatchToPictureStore = 'images/things/';
	
	private $__PatchToIcon = '/icon/';// $__PatchToPictureStore + __PatchToIcon = Patch to icon
	
	private $__PatchToBigPictures = '';
	
	/**
	 * 
	 * @var maksymalna wielkosc (wysokosc i szerokosc) obrazu.
	 */
	protected $_width = 10000;
	
	protected $_height = 12000;
	
	private $__miniaturesWidth = 100;
	
	private $__miniaturesHeight = 100;		
	
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {

	
	
		
		parent::__construct( $request,  $response, $invokeArgs);
		
		$this->view->addScriptPath( '../library/Components/Entite/Management/Pictmanage/views/scripts' );
		//$this->view->addScriptPath( '../library/Management/Pictmanage/' );
			

			$this->_pictureManager = new Pictmanage_library_Manager();
			
	}

	/**
	 * Ustawia szerokoć miniatór (wywietlanych np.: w viewallAction ), tworzonych przez komponent.
	 * @param unknown_type $width
	 */
	protected function _setMiniaturesWidth( $width ) {
		
		
		if ( is_int( $width ) ) {
				
					$this->__miniaturesWidth = $width;
					
		} else {
			
					throw new Exception ('Niewłaciwa parametr szerokosci miniatury(Pictmanage_controllers_PicturemanagerController->_setMiniaturesWidth)');			
		}		
		
	} 
	
	
	/**
	 * Ustawia wysokosć miniatór (wywietlanych np.: w viewallAction ), tworzonych przez komponent.
	 * @param unknown_type $width
	 */
	protected function _setMiniaturesHeight( $height ) {
		
		
		if ( is_int( $height ) ) {
				
					$this->__miniaturesWidth = $height;
					
		} else {
			
					throw new Exception ('Niewłaciwa parametr wusokoci miniatury(Pictmanage_controllers_PicturemanagerController->_setMiniaturesWidth)');			
		}		
		
	} 
	
	
	/**
	 * @param unknown_type $id
	 */
	
	private function __getConcretePath( $id ){
		

			$concretePaths = new  Pict_library_ConcretedPaths ( $id );
						
			$concretePaths = $this->_setPaths( $concretePaths );
		
		
			return $concretePaths;
	}
	
	/**
	 * Dodatkowo usuwanie katalogu ze zdięciami.
	 */
	
	public function deleteAction() {
		
		
		$id =(int) $this->_request->getIntParam( 'id' );
		
		parent::deleteAction();
		
		
		if  ( is_dir ( $dir = $this->__getConcretePath( $id )->getPathFromIndexToImages() )){
		
					Class_dir_dir::deleteDirectory( $dir );
		}
		
		
	}
	
	
/**
 * Dadaje pozycje "dodaj zdiecie" do menuAction.
 * @param unknown_type $id
 */	
	/*	 
protected function _prepareMenuforViewOneAction( $id ) {
		
		
			parent::_prepareMenuforViewOneAction($id);
	 
								
			$this->view->actionMenu->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module' => $this->_request->getModuleName(),
																	'controller'=> $this->_request->getControllerName() ,
																	'action'=>'addpict',
																	'label' => 'Dodaj zdięcie',
																	'privilege'=>'addpict',
																				'resource'=>$this->_request->getModuleName().':'.$this->_request->getControllerName(),
																	'params' => array( 'id' => $id ) 
															)  
													)
								);
	
	
	}
	*/
	
	
	/**
	 * Usuwanie Obrazka
	 * 
	 */
	public function deletepictAction() {
		
		
		//$this->view->setScriptPath ( $this->_sctiptPath );
		
		
		$id =(int) $this->_request->getIntParam( 'id' );
		
		$picName = $this->_request->getParam( 'pic' );
		
		
		//$patchToDelete =  'images/things/' . $id . '/' . $picName;
		
		$patchToDelete =  $this->_path->getPathFromIndexToImages().'/' . $id . '/' . $picName;
		
		
		if ( ! (is_int( $id ) && ( $id > 0 ) )  ) 
		
				throw new exception("Niepoprawne id");
		

	
			
		
		if ( $this->_pictureManager->delete( $patchToDelete ) ) {
		
			
				Class_file_file::deleteDir( $this->_path->getPatchToDirectory($id) );
				
				$this->_redirect( $this->_request->getModuleName() . '/' . $this->_request->getControllerName() . '/viewone/id/' . $id , array( "code" => 302 ) );
				
		
		} else {
		
				
				echo 'Obraz nie został usunienty '.$this->_pictureManager->getError();
		}
				
		
	
	}

	/**
	 * Dodawanie obrazka.
	 */

	public function addpictAction()	{


		//$this->view->setScriptPath ( $this->_sctiptPath );
		//$form = new Class_picture_addForm();
		
		
		$form = new Pictmanage_library_addForm();
		

		$id = $this->_request->getIntParam( 'id' );

	
		if ( $id == 0 ) {
			
			if ( Zend_Registry::isRegistered( 'id' )){
				$id = Zend_Registry::get( 'id' );
			}else{
				$id = $form->id->getValue();
			}	
			
			if ( ! $id > 0 ){
			
			//	var_dump($this->getRequest()->getParams());
			//	die();
			//	throw  new Exception( 'nie poprawne id. PicturemanagerController->addAction' );
			}
				
		}
		
		
		$form->id->setValue( $id );
		
	
		if ( $this->_request->isPost() )  {
			
			
				if ( $form->isValid($_POST) )	{
					
	//Gdzie zapisać				
						$newDir = $this->_path->getPathFromIndexToImages().'/'. $form->id->getValue();
		
						$concretePaths = new  Pict_library_ConcretedPaths ( $id );
						
						$concretePaths = $this->_setPaths( $concretePaths );
						 
						$patchToFreshPicture = $form->uploadFile( $concretePaths, $this->_pictureManager );	

//echo $patchToFreshPicture;

//if (file_exists($patchToFreshPicture)) echo "istnieje";

						//$this->_pictureManager->add( $patchToFreshPicture, $this->_path->getPatchToDirectory( $id ) , $this->_path->getPathToIcons( $id ), $this->_width, $this->_height, $this->__miniaturesWidth, $this->__miniaturesHeight  );
						//if ( $this->_pictureManager->add( $patchToFreshPicture, $concretePaths , $this->_path->getPathToIcons( $id ), $this->_width, $this->_height, $this->__miniaturesWidth, $this->__miniaturesHeight  ) ){
						if ( $this->_pictureManager->add( $patchToFreshPicture, $concretePaths , $this->_width, $this->_height, $this->__miniaturesWidth, $this->__miniaturesHeight  ) ){
							
									$this->_redirect( $this->_request->getModuleName() . '/' . $this->_request->getControllerName() . '/viewone/id/' . $id , array( "code" => 302 ) );	
									
						} else {
							
								$mennssage = $this->_pictureManager->getError();
						}

						
						$form_element_file = $form->getElement( 'fileUpload' );	
				}
			} else {


			Zend_Registry::set( 'id', $id );
			
			$form->setAction(

					$this->_request->getBaseUrl()
	
					.'/'.$this->_request->getModuleName()

					.'/'.$this->_request->getControllerName()

					.'/'.$this->_request->getActionName()				

			 );

		}

		$this->view->form = $form;
	}

	
	/**
	 * Ustawianie jako etykiety.
	 */
	public function setasmainAction() {
		
		
		$this->_helper->viewRenderer->setNoRender( true );
			
		$id =(int) $this->_request->getIntParam( 'id' );
		
		$picName = $this->_request->getParam( 'pic' );
		
		
		if ( is_int($id) && ( $id > 0 ) ) {
			
			
		//	$pic = new Class_picture_manager();
			$concretePaths = new  Pict_library_ConcretedPaths ( $id );
						
			$concretePaths = $this->_setPaths( $concretePaths );
			
			if ( ! $this->_pictureManager->setAsMain ( $this->_path->getPathFromIndexToImages(). '/' . $id . '/' . $picName, $concretePaths ) )
			
						echo $this->_pictureManager->getError();
				
			//else 
			
						//echo "ustawićem";
				
			//$this->_forward('viewone', $this->_request->getControllerName(),$this->_request->getModuleName(),array('id'=>$id));
			
			$this->_redirect( $this->_request->getModuleName() . '/' . $this->_request->getControllerName() . '/viewone/id/' . $id , array( "code" => 302 ) );
						
		}
		
	}
		
}

?>