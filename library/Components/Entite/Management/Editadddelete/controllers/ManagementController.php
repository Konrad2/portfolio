<?php

/** 
 * @author Konrad
 * @package Management
 * @package Entite
 * Rozszerza kontroller zarzdzania o edytowanie.
 * 
 */

class Editadddelete_controllers_ManagementController extends Addanddelete_controllers_ManagementController {
 
	
	protected $_redirectAfterEdit;
	
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())  {
		
		
			parent::__construct( $request,  $response, $invokeArgs);
			
			$this->view->addScriptPath ( '../library/scripts/Management/Editadddelete/' );
			
			
			$this->_redirectAfterEdit = new Zend_Navigation_Page_Mvc( array (
	 																		'module' => $this->_request->getModuleName(),
	 																		'controller' => $this->_request->getControllerName(),
	 																		'action'=> 'viewone'
	 																		)
	 																);
	 														
	 		$this->_pdoInternaceName = 'FormDb_Editable';
	}
	
	/*
 	protected function createFormDb(){
	 	
	 	return new FormDb_Editable();
	 }
	*/
	/**
	 * Edycja.
	 */
	public function editAction() {
		
		/*
			require_once $this->patchToFormDb;
			
			$className = $this->formDbName;

			$formDb = new $className ();
*/
			$this->_redirectAfterAddAction->setAction( 'viewone' );
			
			
			$formDb = $this->getFormDb();		
							
			$param =  $this->param();
			
	
			$param->setAction('add');
			
			$formDb->build ( $param );
						

			if ( $this->_request->isPost() ) {
			 
				
			    if ( $formDb->isValid( $_POST ) ) {
			    	
			    	
				    	//$formDb->updateDb();
				    	$freshRow = $formDb->updateDb();
				    
				    	Zend_Registry::set( 'message', 'Uaktualniono pomyslnie' );
                                          
				    	// wychaszowane 27-05-2015 ponieważ nie wyświetlało się poprawnie po edytowaniu adresu w courieraddress
				    	if( !$this->_idOverriding ) {
				    
		            			$this->_redirectAfterEdit->setParams( array ( 'id' => $freshRow['id'] ) );
				    		
				    	}
				    	
 
				    	$this->_redirectAfrerEdit();

			    } else {


					echo "Dane niepoprawne<br/>";

					$this->view->form = $formDb;

				}


			} else {
				
			//jeli nie to	
				
				$id = $this->_request->getIntParam('id');
				
				
				if ( $id > 0 ) {					
					
					$formDb->fill($id);
					
				
					$formDb->setAction(	$this->_request->getBaseUrl()
						.'/'
						.$this->_request->getModuleName()
						.'/'
						.$this->_request->getControllerName()
						.'/'
						.$this->_request->getActionName() );
						
					$this->view->form = $formDb;
					
					
				} else {
		
					
					throw new Exception('Nie poprawne id');
					
				}
				
				
			}	
				
	}
	
	
 	protected function _redirectAfrerEdit(){		
        
		$this->_redirect ( $this->_getUrlFromNavi( $this->_redirectAfterEdit )
								
	          					, array('code' => 303 ));
	 }
	
	 
	 
	protected function _prepareMenuforViewOneAction( $id ) {
		
		
			parent::_prepareMenuforViewOneAction($id);
	 
								
			$this->view->actionMenu->addPage( new Zend_Navigation_Page_Mvc( array( 
												'module' => $this->_request->getModuleName(),
                                                                                                'controller'=> $this->_request->getControllerName() ,
												'action'=>'edit',
												'label' => 'Edytuj',
												'privilege'=>'edit',
												'resource'=>$this->_request->getModuleName().':'.$this->_request->getControllerName(),
												'params' => array( 'id' => $id ) 
															)  
													)
								);	
	
	}
	

}

