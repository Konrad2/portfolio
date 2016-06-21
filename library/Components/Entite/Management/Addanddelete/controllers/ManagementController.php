<?php

/**
 * Nalerzy poda nazwe edytowanej tabeli w bazie danych. 
 * @author Konrad
 * @package Management
 */
	 
class Addanddelete_controllers_ManagementController extends Abstract_controllers_aManagementController{

	
	
	/**
	 * Przechowuje miejsca przekierowania po wskończeniu akcji addAction.
	 * @var Zend_Navigation_Page_Mvc
	 */
	
	protected $_redirectAfterAddAction;
	
	protected $_redirectAfterDelete;
	
	/** 
	 * Scierzka do klasy FormDb.
	 * @var FormDb
	 */
	
	//protected $__patchToFormDb = '../library/Components/Entite/Management/Addanddelete/library/FormDb.php';
	
	
	/**
	 * Glówna akcja zapewniajaca interakcje z urzydkownikiem.
	 * Po dodaniu przechodzi domy�lnie do index/index.
	 */
	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){
	 	
	 	
	 	
	 	parent::__construct($request, $response, $invokeArgs);
	 	
	 	//po dodaniu przekieruje się do viewall
	 		 	
	 	$this->_redirectAfterAddAction->setAction( 'viewall' );
	 	
	 	$this->_redirectAfterAddAction->setController( $this->_request->getControllerName() );
	 	
	 	$this->_redirectAfterAddAction->setModule( $this->_request->getModuleName() );
	 	
	 	
	 	$this->_redirectAfterDelete = new Zend_Navigation_Page_Mvc( array (
	 																		'module' => $this->_request->getModuleName(),
	 																		'controller' => $this->_request->getControllerName(),
	 																		'action'=> 'viewall'
	 																		)
	 																);
	 	
	 	
	 	//$this->view->addScriptPath ( '../library/Components/Entite/Management/Addanddelete/views/scripts/' );
	 	$this->view->addScriptPath ( '../library/script/Management/Addanddelete/' );
	 	
		$this->_pdoInternaceName = 'FormDb_FormDb';
	 }
	 
 
	/**
	 * 
	 * Definiujemy gdzie ma zostać przekierowanie po dodanie elementu.
	 * 
	 * @param $navigation
	 */
	 
	 protected function _setRedirectAfterAdd(Zend_Navigation_Page_Mvc $navigation){
	 	
	 	$this->_redirectAfterAddAction = $navigation; 
	 }
	 
	 protected function createFormDb(){
	 	
	 	
	 	//return new FormDb_FormDb();
	 	$instance = new $this->_pdoInternaceName();

	 	//---------------------
				
						$name = new Zend_Form_Element_Text('name');
						
						$name->setLabel('Nazwa')
								->setRequired(true)
								->addErrorMessage('Pole musi zawierać treść')
								->addValidator(new Zend_Validate_NotEmpty(), true)
								->addValidator(new Zend_Validate_StringLength(0, 64), true);
								//->addFilter(new Zend_Filter_Alnum());
								
						$instance->addElement( $name );  
						
						
						$description = new Zend_Form_Element_Textarea('description');
						
						$description->addValidator(new Zend_Validate_StringLength( 0, 60000, 'UTF-8' ), true )
								->setRequired(true)
								//->addErrorMessage('Pole musi zawierać treść')
								->addValidator ( new  myZend_Validate_TextPl() )
								->addValidator(new myZend_Validate_NotEmpty(), true)						
								->setLabel('Opis')				
								->addFilter('StringTrim');
								
						 $instance->addElement($description);
								
				
				/*		
						$model =  new Zend_Form_Element_Text('model');
							$model->setLabel('Model')							
								->addValidator(new Zend_Validate_StringLength(0, 36, 'UTF-8'), true)
								->addFilter(new Zend_Filter_Alnum());
								
						$instance->addElement($model); 

						$description = new Zend_Form_Element_Textarea('text');
						
						$description->addValidator(new Zend_Validate_StringLength( 0, 60000, 'UTF-8' ), true )	
								->addValidator ( new  Class_Validators_tekstPl() )
								->setLabel('Text')				
								->addFilter('StringTrim');
								
						 $instance->addElement($description);
				*/
						
						
					
					
					    
						//$this->setEnctype('multipart/form-data');
						//$this->setEnctype('text/plain');
								
						 $submit = new Zend_Form_Element_Submit('Dodaj');
						 
						 $submit->setIgnore(true);		
						
				         $instance->addElement($submit);

			$instance->setTableName( $this->_tableName );
				         
			return $instance;
		
	 }
	 
	 
	
	/**
	 * @todo Zamienić tworzenie formy w createForm a getForm spróbować sprywatyzować :)  Tak aby potczas tworzenia nowego modułu developer definiował w createFormDb forme i spokuj miał.
	 */ 	 
	 protected function getFormDb() {		
		
		
		$instance =  ( empty ( $this->_formDb )    ) ?  $this->createFormDb() : $this->_formDb ;

		
		return $instance;
		
	}
	
	
	 
	public function addAction() {
		//require_once $this->patchToFormDb;
		//$className = $this->formDbName;		
		//$formDb = new $className ();
		//  ||
		//  \/
		
		
		$this->_redirectAfterAddAction->setAction( 'viewone' );
			
			
		$formDb = $this->getFormDb();
		
		$formDb->build ( $this->param() );				
	
		
		if ( $this->_request->isPost() ) {
			
			
		    if ( $formDb->isValid( $_POST ) )	{
		    	
		    	
			    	$freshRow = $formDb -> formToDb();			    
			    
			    			    	
	    	 	 	$this->_helper->flashMessenger->addMessage("Dodano pomyslnie");
	    	  
	    	 	 	    	 	 	
	    	 	 //	$this->_redirectAfterAddAction->setParams( array ( 'id' => $freshRow['id'] ) );
	    	 	 	
	    	 		
	    	 	 	// zrobić to w redirect przekazać param
	    	 	 self::_redirectAfrerAdd( array ( 'id' => $freshRow['id'] ) );
	    	 	 
	          		
		    } else {		    			    	
								
					$this->view->form = $formDb;				
			}
			
			
		} else {
			
				$this->view->form = $formDb;				
		}
		
	}
	
	/**
	 * Przekierowuje urzydkownika po wstawieniu wiersza do bazy danych. Przekierowanie do miejsca ustawionego w we właściwości _redirectAfterAddAction(Zend_Navigation_Page_Mvc). 
	 * @param array $params
	 */
	protected function _redirectAfrerAdd( array $params = null ){
		
		
		if ( $params !== null ) {
			
			
					$oldParam = $this->_redirectAfterAddAction->getParams();

					foreach ( $oldParam as $key => $value ) {
						
						$params [ $key ] = $value;
					}
					
				$this->_redirectAfterAddAction->setParams( $params );
		}
		
	
		$this->_redirect ( $this->_getUrlFromNavi( $this->_redirectAfterAddAction )
								
	          					, array('code' => 303 ));
	    	 	 	
		
	}
	
	
	/**
	 * Zwraca adres pod który ma zostać przekierowany urzytkownik po akcji add. Uwzględnia równierz parametry.
	 * @return string
	 */
	protected function _getUrlFromNavi( Zend_Navigation_Page_Mvc $navigation) {
		
		/*
		$url = $navigation->getModule()
	          					.'/'
	          					. $this->_redirectAfterAddAction->getController() 
	          					. '/'
	          					.  $this->_redirectAfterAddAction->getAction(); 
		*/	

			$url = $navigation->getModule()
	          					.'/'
	          					.  $navigation->getController()
	          					. '/'
	          					. $navigation->getAction(); 
		
	     
		foreach (  $navigation->getParams() as $name => $value ) {
					
				$url .= '/' . $name . '/' . $value;
		}
		
		
		
		
		return $url;
			
	}
	

	
	
	public function deleteAction() {		
		
	
		
		$form = new Class_forms_Confirmation( $this->_request->getModuleName() );	

		 $id = null;
		
		 
		if ( $this->_request->isPost() ) {
			
			
			$this->_helper->viewRenderer->setNoRender( true );
			
			$pom = $this->_helper->flashMessenger->getMessages();

			$id = is_array($pom) ? array_pop( $pom ) : null;
			
			
			if ( !is_int($id)){
				$id = $this->_request->getIntParam('id');
			}
			
				
			if ( $form->getValue($this->_request ) ) {

				
				$formDb = $this->getFormDb();
				
				$formDb->build( $this->param() );
				
				
				try {
					
					$formDb->delete($id);
					//$formDb->deleteEntite($id);
					
				//	Class_file_file::deleteDir( $this->_path->getPatchToDirectory($id) );
					
					
					 $this->_redirectAfrerAdd( );
					
				}
				
				catch ( Exception $ex ) {
					
					
					echo 'ERROR!!!  Nie usunieto elementów'. $ex->getMessage().$ex->getLine();
					
				}
				
				
			} else {
				
								
				//$this->_redirect('/'.$this->getBaseUrl.'/'.$this->_request->getModuleName().'/'.  $this->_request->getControllerName() . '/viewall');
			 self::_redirectAfrerAdd( array ( 'id' => $id ) );
			}
			
			
		} else {
			
			
			  $id = $this->_request->getIntParam('id');
			  
		      $this->view->title = $id;
		      
		      $this->_helper->flashMessenger->addMessage($id);

		      $this->view->form = $form;
		      
		}
		
	}
	
	 protected function _redirectAfrerDelete( ){
	 	
	 	
		$this->_redirect ( $this->_getUrlFromNavi( $this->_redirectAfterDelete )
								
	          					, array('code' => 303 ));
	 }
	 
	
	 
	/**
	 * Tworzy menu wyświetlane w akcji viewallAction. Menu jest przechowywane we właściwości widoku actionMenu jako Zend_Navigation.
	 */
	 
	protected function  _prepareMenuforViewAllAction() {
		
		
		parent::_prepareMenuforViewAllAction();			

		
		if ( ! isset(	$this->view->actionMenu ) )
				
					Abstract_controllers_aViewController::__prepareMenuForAction();
					
					
		
		$this->view->actionMenu->addPage( new Zend_Navigation_Page_Mvc( array( 
																				'label'=>'Dodaj',
																				'module'=> $this->_request->getModuleName(),
																				'controller'=>$this->_request->getControllerName(),
																				'action' => 'add',
																				'privilege'=>'add',
																				'resource'=>$this->_request->getModuleName().':'.$this->_request->getControllerName(),
																				 ) ));
		
	}
	
	
	
	protected function _prepareMenuforViewOneAction($id) {
		
		
			parent::_prepareMenuforViewOneAction($id);
	 
	
			
			$this->view->actionMenu->addPage( new Zend_Navigation_Page_Mvc( array( 
																	'module' => $this->_request->getModuleName(),
																	'controller'=> $this->_request->getControllerName() ,
																	'action'=>'delete',
																	'label' => 'Usuń',
																'privilege'=>'delete',
																				'resource'=>$this->_request->getModuleName().':'.$this->_request->getControllerName(),
																	'params' => array( 'id' => $id ) 
															)  
													)
								);
				
	
	}
	
	/**
	 * Nadpisanie metody Z Related kontroler w celu uzyskania informacji po kolejnych krokach dodawania().
	 * Dane trzymane są w sesji a nie w Zend_Registry.
	 */
	
	protected function _getParent() {
		

		$ns = new Zend_Session_Namespace('management');
		
		
		$row = parent::_getParent();
		
		
		if ( $row ) {
		
				$ns->overridingRow = $row;				
		
		} else {
		
				$row = $ns->overridingRow;
		
				if ( ! $row ) {
		
						throw new Components_Entite_View_ViewRelated_library_Exceptions_noOverridingRow('W Addanddelete_controllers_ManagementController->_getParent nie odnaleziono wiersza w ');
				}
		}
		
		return $row;
		
	}
	
	
}
	
?>