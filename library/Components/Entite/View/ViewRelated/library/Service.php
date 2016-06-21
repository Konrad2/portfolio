<?php

/**
 * Klasa zapewnia dostemp do informacji o encji z nadrzędnego modułu
 * podłączonym modułom. Urzyj metody setRelatedParent aby podłonczone moduły
 * mogły mieć informacje dostemp do informacji z modułu nadrzędnego. Dostęp
 * do informacji o nadrzędnym module zapewnia metoda getRelatedParent.
 * @author Konrad
 * @version 1.0
 * @updated 21-gru-2012 18:58:29
 */
class Components_Entite_View_ViewRelated_library_Service {
	
	protected $__nameInRegistry = 'Connections';
	
	
	public function setRelatedParent( $param, Zend_Db_Table_Row $row ) {

		$input = array( $param->getModule() => array ( $param->getController() => array( $param->getAction() => $row ) ) );
		
		
		//$value = 'fesf';
		
		//Zend_Registry::set('index', $value);
		
		Zend_Registry::set( $this->__nameInRegistry, $input );
		
		
		//Zend_Registry::set( 'f', 45 );
		 
		//throw new exception('set');
		
	}
	
	
	/**
	 * Umożliwia przechowywanie rekordu Zend_Db_Table_Row dzięki czemó moduły mogą pobrć rekord nadrzędnego modułu.
	 * 
	 * @param Zend_Db_Table_Row $param
	 */
	
	public function getRelatedParent( Zend_Navigation_Page_Mvc $param ) {
		
		
		//	throw new exception('get');
		 //Zend_Registry::get('index');
		
		$result = false;

		//$Zend_Registry = Zend_Registry::getInstance();
			 
			// $result = $Zend_Registry[ $param->module() ] [ $param->controller() ] [ $param->action() ] ;
			 
			
		
		if ( Zend_Registry::isRegistered( $this->__nameInRegistry ) ) {
			
			 $s = Zend_Registry::get ( $this->__nameInRegistry );
			 
			 if ( isset( $s [ $param->getModule() ] [ $param->getController() ] [ $param->getAction() ])){
			 	$result =  $s [ $param->getModule() ] [ $param->getController() ] [ $param->getAction() ];
			 }
			// $result =  $s ['things' ] [ 'management' ] [ 'viewone' ];
			 
		}
		
			
		return $result;
	}
	

}
