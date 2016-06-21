<?php

/**
 * 
 * @author Konrad
 * @package Courier
 *
 */
class Createaccount_indexController extends abstract_Controllers_baseController 
{	
	public function indexAction()
	{		
		$form = new components_createaccount_library_forms_form();

		$this->view->form = $form;
		
		if ( $this->_request->isPost() ){
			
			if( $form->isValid( $this->_request->getPost() )){
				
				$account = new components_createaccount_models_Account();
				
				$account->addUser($form->getValues());
			}
		}
	}
	
	public function checkloginAction(){
		
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		
		$login = $this->getRequest()->getParam('login');
		
		$form = new components_createaccount_library_forms_form();		
		$formElementLogin = $form->getElement('login');		
		
	
		if ( $formElementLogin->isValid( $login ) ){
			
		 $validator = new Zend_Validate_Db_RecordExists(
		    array(
		        'table' => 'account',
		        'field' => 'login'
		    	)
			);
			
		 echo  $validator->isValid($login) ;
	}
	
	}
}