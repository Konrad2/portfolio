<?php

/**
 * @author Konrad
 * @version 1.0
 * @created 09-lip-2010 13:56:10
 */
class accounts_addandeditController extends abstract_Controllers_addandeditController {
	
	
	var $m_formDbParent;
	
	
	public function init() {
		
		
		$this->formDbName = 'formDbCreate';
		
		$this->patchToFormDb = '../application/modules/accounts/library/formDbCreate.php';
		
		
		parent::init();
		
	}
        
        public function registrationAction(){
            
            $form = new components_createaccount_library_forms_form();
            
            $formAddress= new Components_Address_library_forms_Address();
            $formAddress->removeElement('Edytuj');          
            
            $form->addSubForm($formAddress ,'address');
            $form->getElement('Wyślij')->setOrder(9);
            if( $this->_request->isPost()){
                
                if($form->isValid($_POST)){
                    $data = $form->getValues();

                    $personModel = new Class_Models_Person();
                    $newPersonRow = $personModel->addPerson($data);
                    
                    $data['id_person'] = $newPersonRow->id;
                    
                    $addressModel = new Components_Address_models_Address1();
                    
                    $newAddresRow = $addressModel->addAddress($data['address']);
                    
                    $data['id_address'] =  $newAddresRow->id;
                    
                    $model = new components_createaccount_models_Account();
                    $newAccountRow = $model->addUser($data);
                    
                    $this->_request->setPost(array(
                        'someKey' => 'someValue'
                        ));
                    
                    $baseURL = $this->getRequest()->getHttpHost();
                     $this->_helper->redirector->gotoUrl('');
                    
                }
            }
             
           
            $this->view->form = $form;
            
        }
	
	
}
?>