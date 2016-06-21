<?php
/**
 * Klasa tworzy poláczenie pomiédzy modulami. Aby wywolac akcje innego modulu nalerzy urzyc metody call. Dołanczany moduł musi realizować interfejs iRelated.
 * Moduł główny będzie wywoływać metodę viewlabelAction w nowo skojarzonym module.
 * 
 * Wywoluje akcje w innych modulach. 
 * @author Konrad
 * @package Connections
 *@todo zmienić schemat danych w pliku connections.xml
 */
class Components_Entite_Connections_library_Connector {
	
	
	private $__actionInRelatedMod = 'viewlabel';
	
	//private $__moduleRelatedName = 'view';
	private $__moduleRelatedName = 'management';
	
	
	/**
	 * Aby połączyc modul z innym nalerzy w pliku connections stworzyć sekcję o nazwie modułu,  w niej gałąź o nazwie controlerra z którym jest połączony moduł, o jakiej wartoci :)
	 * @param unknown_type $param
	 * @todo Zmienić strukturę pliku xml. Podawać się powinno nazwę modułu, kontrolera oraz akcji. Analogicznie do Zend_Navigacion.
	 */
	
	public function connect( $param, Zend_Db_Table_Row $row  ) {


		$system = new Class_system ();

		$mod = $system->getConnections ( $param );		

		//return $mod;	
		
		
		if ( $row !== null ) {

		
			$relatedService = Components_System_library_System::service( 'iRelated' );
			
			$relatedService->setRelatedParent( $param, $row );
			
		}
		
		
		$this->callActionAnoderModeules( $mod );
	}
	
	
	/**
	 * 
	 * @param array  $mod
	 */
	private function callActionAnoderModeules( array $mod ) {
	
		
		if ( ! empty ( $mod ) ) {
			
			$action = new Zend_View_Helper_Action ();
		
			foreach($mod as $m) {	
				
				echo $action->Action ($this->__actionInRelatedMod,
									$this->__moduleRelatedName,
									$m);
				/*
				echo $this->_helper->action( $this->__actionInRelatedMod,
									$this->__moduleRelatedName,
									$m);
									array('param' => $this->id) );
									*/
			}
		
		} else {
			
				//throw new Exception ('Czeć Konrad. Niestety nie znalazłem połączonych akcji');
		}
		
	}		

}

?>