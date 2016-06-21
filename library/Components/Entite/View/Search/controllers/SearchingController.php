<?php
/**
 * Wywietla rekordy biorąc pod uwagę krytewia wyszukiwania. Implementuje interfejs iView.
 * @author Konrad
 * @package Search
 */

class Components_Entite_View_Search_controllers_SearchingController extends ViewEntites_controllers_ViewentitiesController {
	
	
	protected $_searcher;
	
	protected  $_whatShow_One = array ('name'=>'Nazwa produktu', 'price'=>'Cena');
	
	protected $_modelClassName = 'Components_Entite_View_Search_models_View';
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {			

		//throw new exception("hellow");
				
		
			parent::__construct( $request,  $response, $invokeArgs );	
		
			$this->_model = $this->createModel( $this->_modelClassName );
			//$this->_modelName = Components_Entite_View_Search_models_View;
			
	}
	/*
	public function addparamAction() {
		
		
		$p = $this->_request->getAlNumParam('param');	
			
		
		if ( ! empty( $p ) ) {
		
		//	if ($$this->odel->isCorect($p))
		//	{
				$system = new Class_system();
				
				$system->clearCriterion();
				
				$system->addCriterion($p);
		//	}
		}		
		
		
			$contract = Class_system::getContract( $this->param() );
		
			//TODO  System::resetPaginator();
			
			$this->_forward( 'viewall', 'view', $contract['view'] );
		
	}
	
*/
	/*public function init () {
		
		
		parent::init();
		
		require_once '../application/modules/things/library/thingsSearcher.php';
		
		$this->_searcher = new Components_Entite_View_Search_library_Searcher ( );
		
	}	
	*/
	
	function indexAction () {
		//$this->_forward('view','index');
	}
		

	public function viewallAction () {

		
		// Podmiana wtybutu. Modelu realizującego interfejs iView.	

		
			$this->_model->setNavigation( $this->_getNavigation() );
			
			return parent::viewallAction();
		
	}
	
	
	protected function _getNavigation() {
			
		
			return new Zend_Navigation_Page_Mvc( array( 'module' => $this->_request->getModuleName(), 'controller' => $this->_request->getControllerName(), 'Action' => $this->_request->getActionName() ) );
			
	}
	
/*
	public function viewoneAction() {

		
		$this->view->setScriptPath('../application/modules/things/views/scripts');
		
		$this->view->layout()->setlayout('thingslayout');

		$id = $this->_request->getIntParam ( 'id' );
		

		$pictureManager = new Class_picture_manager();
		
		$dir = 'images/things/'.$id;

				
		$this->view->current = $pictureManager->getMainpath($dir);
		
		
		if ( file_exists( $dir.'/main.jpg' ) ) {
			
	
				$size = getimagesize($dir.'/main.jpg');
		
				$this->view->currentWidth = $size[0];
		 
				$this->view->currentHeight = $size[1];
			
		}

		
		$this->view->icons = $pictureManager->getIcons($dir);		

		$this->view->id = $id;

		
		parent::viewoneAction();
		
	}
	*/
	
	
	protected function isCorect ( $param ) {
		
		$result = true; 
		
		return $result;
		
	}

	
	/*
	public function __call( $method, $args ) {
		
		
		if ( 'Action' == substr( $method, -6 ) ) {

			
            return $this->_forward( 'badurl', 'Error' );
            
        }

        
        throw new Exception('Niewłaciwa metoda"'
                            . $method
                            . '" called',
                            500);
                            
	}	
	*/
	
}