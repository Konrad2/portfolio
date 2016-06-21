<?php
/**
 * Dodanie nowego kryterium automatycznie anuluje warznoć poprzednich kryteriów.
 * @author Konrad
 * @package Search
 */
//class Components_Entite_View_Search_library_OneCriterion extends Components_Entite_View_Search_library_Searcher {
class Components_Entite_View_Search_library_OneCriterion extends Components_Searcher_library_Searcher {
	

	/**
	 * Dodanie nowego kryterium automatycznie anuluje warznoć poprzednich kryteriów.
	 * 
	 * @param string $key nazwa tabeli której dotyczy kryterium wyszukiwania
	 * @param unknown_type $value wartosć
	 * @param Zend_Navigation_Page_Mvc $navigation Musi zawierać nazwy: modułu, kontrolera oraz akcji których dotyczy kryterium.
	 * @example
	 * $search = new  Components_Entite_View_Search_library_Searcher();	 * 
	 * $search->add('category', 'cars', Zend_Navigation_Page_Mvc( array ( 'module'=>'pojazdy', 'controller'=>'management', 'action'=>'viewall') );
	 */
	public function add( $key, $value , Zend_Navigation_Page_Mvc $navigation ) {
		
			$ns = new Zend_Session_Namespace( $this->sesName );
			
	//echo'add '.$navigation->getModule().' '.$navigation->getController().' '.$navigation->getAction();
		    $ns->params[ $navigation->getModule() ] [ $navigation->getController() ] [ $navigation->getAction() ] = array( $key => $value );
		  
	}

}

