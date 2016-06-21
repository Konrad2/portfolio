<?php

/**
 * Kontroler s�yrzy do dodawania z formularza do bazy danych.
 *
 * Wymaganya jest klasa formDb. Namiary na ni� podajemy w init(). Zmian� modelu ustawiamy przez w�a�ciwo�� setModel($modelName), do kturej przesy�amy nazwe 
 * nowej klasy. Nowa klasa musi znajdowa� si� w katalogu models.
 *
 * @uses absract_addandeditModel Musimy stworzy� klas� dziedzicz�c� po addandeditModel. 
 * @package Controller
 * @subpackage AddAndEdit
 * @author Konrad
 *	@abstract abstract_conteroller
 */

//require_once '../library/controller.php';
abstract class abstract_Controllers_addandeditController extends abstract_Controllers_baseController {
	
	/**
	 * Nazwa sekcji w pliku konfiguracyjnym w kurym zdefiniowany jest formularz.
	 * @var $section string
	 */
	
	
	protected $section;
	
	
	/**
	 * @var string nazwa klasy w dziedzicz �cej po formDb.
	 */
	
	protected $formDbName;
	
	
	/**
	 * 
	 * @var string �cie�ka do pliku z klasom dziedzicz�c� po formDb.
	 */
	
	protected $patchToFormDb;
	
	
	/**
	 * Wywo�ujemy bazowy parent::init().
	 * Podajemy:
	 *  - $this->formDbName nazwa klasy  z interfejsem addandeditModel
	 *  - $this->patchToFormDb �cie�ka do klasy.
	 */
	
	public function init() {
		
		
		parent::init();
		
		//$this->view->setScriptPath('../library/script');
		$this->view->addScriptPath('../library/script');
		
	}
	
	
	/**
	 * G��wna akcja zapewniaj�ca interakcje z urzydkownikiem.
	 * Po dodaniu przechodzi domy�lnie do index/index.
	 */
	
	public function addAction() {
		//require_once $this->patchToFormDb;
		//$className = $this->formDbName;		
		//$formDb = new $className ();
		//  ||
		//  \/
		
		$formDb = $this->getFormDb();
		
		$formDb->build ( $this->param() );
				var_dump($this->param() );
	//	$formDb->build( $this->param() );

		
		if ( $this->_request->isPost() ) {
			
			
		    if ( $formDb->isValid($_POST) )	{

		    	
		    	//$formDb->isCorect() {
		    	
			    	$formDb->formToDb();			    
			    
			    	$formDb->reset();
			    
			   // Zend_Registry::set('message', 'Dodano pomy�lnie');
	    	 	 	$this->_helper->flashMessenger->addMessage("Dodano pomyslnie");
	    	  
	          		//$this->_forward ( 'viewall', 'view' , $this->_request->getModuleName() );
	          		$this->_redirect ( $this->_request->getModuleName().'/view/viewall' , array('code' => 303) );
	          		
		    //	}
	          		
		    } else {
		    			    	
					echo "dane niepoprawne<br/>";
				
					$this->view->form = $formDb;
				
			}
			
			
		} else {
			
				$this->view->form = $formDb;
				
		}
		
	}
	
	

	public function editAction() {
		
		/*
			require_once $this->patchToFormDb;
			
			$className = $this->formDbName;

			$formDb = new $className ();
*/
		
			$formDb = $this->getFormDb();			
			
			$param =  $this->param();
			
			$param->setAction('add');
			
			$formDb->build ( $param );
						
			
			if ( $this->_request->isPost() ) {
				
				
			    if ( $formDb->isValid( $_POST ) ) {
			    	
			    	
				    	//$formDb->updateDb();
				    	$formDb->updateDb();
				    
				    	$formDb->reset();

				    	Zend_Registry::set( 'message', 'Uaktualniono pomyślnie pomyślnie' );
		    	    
		            	$this->_forward ( 'viewall', 'view' , $this->_request->getModuleName() );

		            	
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
	
	
	
	public function deleteAction() {		
		
		//$action = $this->_request->get
		
		$form = new Class_forms_Confirmation( $this->_request->getModuleName() );	

		 $id = null;
		
		 
		if ( $this->_request->isPost() ) {
			
			
			$this->_helper->viewRenderer->setNoRender( true );
			
			$id = array_pop( $this->_helper->flashMessenger->getMessages() );
			
				
			if ( $form->getValue($this->_request ) ) {

				
				$formDb = $this->getFormDb();
				
				$formDb->build( $this->param() );
				
				
				try {
					
					$formDb->delete($id);
					
					$this->_redirect('/'.$this->getBaseUrl.'/'.$this->_request->getModuleName().'/view/viewall');
					
				}
				
				catch ( Exception $ex ) {
					
					
					echo 'ERROR!!!  Nie usunięto elementów'. $ex->getMessage().$ex->getLine();
					
				}
				
				
			} else {
				
								
				$this->_redirect('/'.$this->getBaseUrl.'/'.$this->_request->getModuleName().'/view/viewall');
				
			}
			
			
		} else {
			
			
			  $id = $this->_request->getIntParam('id');
			  
		      $this->view->title = $id;
		      
		      $this->_helper->flashMessenger->addMessage($id);

		      $this->view->form = $form;
		      
		}
		
	}



	protected function getFormDb() {
		
		/*	
		require_once $this->patchToFormDb;
		
		$className = $this->formDbName;
		
		$className->build ( $this->param() );	
		
		return new $className ();
		*/
		
		require_once $this->patchToFormDb;
		
		$className = $this->formDbName;
		
		$instance = new $className ();
		
		//$instance->build ( $this->param() );	
		
		return $instance;
		
	}

}
