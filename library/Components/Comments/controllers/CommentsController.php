<?php
/**
 * 
 * Umożliwia dodawanie komentarzy do wywietlanych "entite". 
 * Implementując moduł nalerzy stworzyć tabele w bazie danych. Nazwe tabeli nalerzy wprowadzić do atrybutu _tableName w metodzie _init. 
 * 
 * @package Comments
 * @author Konrad
 *
 */
class Components_Comments_controllers_CommentsController extends Addanddelete_controllers_ManagementController implements  ViewRelated_library_iRelated {
	
	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){

	 	
	 		$this->_foreignKey = 'id_entite';
	 		
	 		parent::__construct($request, $response, $invokeArgs);
	 	
	 		
	 		
	 		$this->setTitle( 'Komentarze naszych klientów' );
	 		
	 		$this->_redirectAfterAddAction->setModule( $this->_getOverridingModule()->getModule() );
				
			$this->_redirectAfterAddAction->setAction( 'viewone' );		
				
			$this->_redirectAfterAddAction->setParams ( array ( 'id' => $this->_getParentId()  ) );
	 		
	 		
	 		$this->_tableName = 'comments';
		
			$this->setWhatShowInAllAction(array ('name', 'label', 'description', 'model') );
		
		
		  	$this->view->setBasePath('../library/script/Comments');
		   	
			$this->view->setScriptPath('../library/script/Comments');

		
	 		
	 		// $this->view->setBasePath('../library/script/Comments');
	 		 
	 		 //$this->view->addScriptPath('../library/Components/Entite/Commonscripts');
	 		 $this->view->addScriptPath('../library/script/Commonscripts');
	 		 
	 		 $this->_model->setConditionIfNoCriterionFound('0=1');
	 		 
	 	}
	
	 	
	 public function viewlabelAction() {
	 	
	 	
	 		try {	 			
	 		
		 		 if ( $row = $this->_getParent() ) {
		 		
		 		 
				 		 $id = (int) $row->id;
				 		 	
				 		 
				 		 	if ( ! is_int ($id) || ($id <= 0 ) )
				 		 	
				 		 			throw new Class_Exceptions_BabIdException('id='.$id);
				 		 					 		 	
				 		 			
				 		 	$searcher = new Components_Entite_View_Search_library_OneCriterion();
				 		 		
				 		 	$nav = new Zend_Navigation_Page_Mvc( array( 'module'=>'Comments', 'controller'=>'management', 'action'=>'viewall') );
				 		 		
				 		 	$searcher->add( $this->_foreignKey, $id,  $nav);

			//	 		 	System::searcher()->addOneCriterion();
				 		 	
				 		 					 		 			
				 		  	$this->_helper->actionStack('viewall');
				 		
				 		//	$this->_helper->viewRenderer->setnorender(true);
				 			
				 			
		 		 } else {
		 		 	
		 		 		Throw new Exception ('Nie odnaleziono wierasz z nadrzędnego modułu');
		 		 }
	 			
	 			
	 		} catch ( Class_Exceptions_BabIdException $ex ) {
	 			
	 			
	 				echo 'Błąd Connections, niepoprawnie przekazane id rodzica. '. $ex->getMessage();
	 			
	 		}

	 		catch ( exception $ex ) {
	 			
	 			
	 				echo 'Wyswietlanie komentarzy nie powiodło się z powodu: '. $ex->getMessage();
	 			
	 		}
	 		
	 
		
	 }
	 	
	 
	 public function viewallAction(){
             
             $idEntite = $this->_request->getIntParam('id');
            
             $m = $this->getModel();
             
             $naviModel = $this->_getNavigation();
         
             
             $search = Components_System_library_System::service( 'iSearch' );		
		
             $search->clear($naviModel);
             
		$criterions = $search->add( 'id_entite', $idEntite  ,  $naviModel);
           			
		$this->view->layout()->setlayout( 'layout' );
		
		parent::viewallAction();
	 }
		 	
	public function init() {
		
		
		
		
	}
	
	/*public function viewallAction(){
		
		throw new Exception('hello world');
	}
	*/
	
	
	
	 protected function getFormDb() {

	 	
	 	 $form = parent::getFormDb();
	 	 
	 	
	 	$elems = $form->getElements();
		
		$elems['name']->setLabel('Autor');
		
		unset($elems['model']);//->setLabel('Tytuł');
		$elems['description']->setLabel('Komentarz');
		
		
		$capcha = new Zend_Form_Element_Captcha('foo', array(
		    'label' => "Kod z obrazka",
		    'captcha' => array(
		        'captcha' => 'Figlet',
		        'wordLen' => 6,
		        'timeout' => 300,
				'message' => 'Nieprawidłowo przepisany kod'
		    ),
		));

		$elems['Captcha'] = $capcha;
                 
                 
		
	//ustawienie klucza
		$elems[ $this->_foreignKey ] = new Zend_Form_Element_Hidden( $this->_foreignKey );
		
		$elems[ $this->_foreignKey ]->setValue( $this->_getParentId() );  	
					
		
		 $form->setElements( $elems );
		
		
		$this->setFormDb( $form );
	 	
	 	return $form;
	 }
	 
/**
	 * Nie dodawanie w "menuAction" dodaj komętarz. 
	 * @param unknown_type $id
	 */
	protected function  _prepareMenuforViewAllAction()  {
		//Comments
	//throw new Exception($this->_request->getModuleName());	
	}
	
protected function __prepareMenuForAction(){}
	 
	 
	public function addAction () {		 
		
			$this->view->addScriptPath( '../library/Components/Entite/Management/Addanddelete/views/scripts' );
		try {
		 	
							
				$this->view->addScriptPath( '../library/Components/Entite/Management/Addanddelete/views/scripts' );
				
			
                                $formDb = $this->getFormDb();
                               
                                if ($this->_request->isPost()){

                                    if ($formDb->isValid($_POST)){

                                        $data = $formDb->getValues();

                                        $modelComments = new Components_Comments_models_Comments();
                                        $modelComments->addComent($data);
                                        
                                        $this->_redirect('/things/management/viewone/id/'.$data[$this->_foreignKey ]);
                                        
                                    }

                                }
				/*
				$elems = $form->getElements();
				
				
				$elems['name']->setLabel('Autor');
				
				$elems['model']->setLabel('Tytuł');
				
				$elems['description']->setLabel('Komentarz');
				
				
				$capcha = new Zend_Form_Element_Captcha('foo', array(
				    'label' => "Kod z obrazka",
				    'captcha' => array(
				        'captcha' => 'Figlet',
				        'wordLen' => 6,
				        'timeout' => 300,
						'message' => 'Nieprawidłowo przepisany kod'
				    ),
				));
		
		//$capcha->setMessage('Nieprawidłowy kod');
				
				$elems['Captcha'] = $capcha;
				
				/*
				$elem->setLabel('Autor');
				
				$elem = $form->addElement($elem);
				
				
				$elem = $form->getElement('label');
				
				$elem->setLabel('Tytuł');
				
				//$elem = $form->setElement('Komentarz');
				
				
				//$elem = $form->getElement('label');
				
				//$elem->setLabel('tytuł');
				
				 $form->setElements( $elems );
				
				
				$this->setFormDb( $form );
				*/
				$this->view->form = $formDb;
                                //parent::addAction();
				
				
		 } catch ( Components_System_library_Exceptions_noServiceFound $Ex){
		 	
		 		echo 'Nie można dodać komentarza. Nie można odnaleć servisu' . $Ex->getMessage();
		 }
		 
		 catch ( Exception $Ex ) {
		 	
		 		echo 'Nie można dodać komentarza. ' . $Ex->getMessage();
		 }
	}
	
	
	
	//-----------------------------------------

	
	/*
	 * 
	private $__foreignKey = 'id_entite';	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){
	 	
	 	
	 	
	 	parent::__construct($request, $response, $invokeArgs);
	 
	 	$formDb = new FormDb_Connect_FormDbClient_oneToMany();
	 	
	 	$formDb->setForeignKey( $this->__foreignKey );
         
         $this->setFormDb( $formDb );
         
	 }
	
	
	public function viewlabelAction() {
		
		
		$this->view->setScriptPath('../library/Components/Comments/views/scripts');

		$id = $this->_request->getIntParam('id');
		
		$this->getModel()->setCriterion( array ( $this->__foreignKey=> $id ) );
		
		$this->viewAllAction();
		
	}
*/
	
	
	
}

