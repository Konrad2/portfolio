<?php

//Zend_Loader::loadClass ( 'controller' );
/**
 * Klasa abstrakcyjna odpowiedzialna za wy�wietlanie rekord�w z bazy danych oraz ich paginacje.
 * Wymagania: model o nazwie modu�u+View dziedzicz�cy po abstract_viewModel.
 * @author Konrad
 * @abstract 
 * @package View
 *
 */

class Log_ViewController extends  ViewEntite_controllers_ViewentiteController {
	
	
	
	public function init(){

		
		$this->_setTableName('account');
		
		$this->setWhatShowInOneAction( array('login'=>'Login', 'id'=>'nr.') );
		
	}

	
	
}
	