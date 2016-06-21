<?php

class Comments_ManagementController extends Addanddelete_controllers_ManagementController implements ViewRelated_library_iRelated {
	
	
	 public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()){
	 	
	 		parent::__construct($request, $response, $invokeArgs);
	 		
	 		 $this->view->setBasePath('../library/Components/Comments/views/');
	 		 
	 		 $this->view->addScriptPath('../library/Components/Entite/Commonscripts');
	 	}
	
	 	
	 	public function viewlabelAction(){
	 		
	 		$this->viewallAction();
	 	}
	 	
	public function init() {
		
		
		$this->_tableName = 'comments';
		
		$this->setWhatShowInAllAction(array ('name', 'label', 'description', 'model') );
	
		//$this->view->setScriptPath('../library/Components/Comments/views/scripts');
		
	
	//	$this->view->deletePaths();
	//throw new exception('d');
	   	  $this->view->setBasePath('../library/Components/Comments/views/scripts');
		$this->view->setScriptPath('../library/Components/Comments/views/scripts');
		
	}
	
	
	public function addAction () {
		
		
		$this->view->addScriptPath( '../library/Components/Entite/Management/Addanddelete/views/scripts' );
		
		$form = $this->getFormDb();
		
		
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
		
		*/
		//$elem = $form->getElement('label');
		
		//$elem->setLabel('tytuł');
		
		 $form->setElements( $elems );
		
		
		$this->setFormDb( $form );
		
		parent::addAction();
	}

}

?>