<?php

class Components_System_library_System {
	

	/**
	 * Zwraca instancje klasy realizującą daną usługę.
	 * @param string $name Nazwa usługi
	 */
	static public function service( $name ) {

		/**
		 * @todo jak będzie potrzebne rozbódować Services na dynamiczny :P
		 * Poprostu tablice trzymać w pamięci lub chyba lepiej w pliku xml, dodając nowe usługi servisu przez dopisanie licia. 
		 */
		$servive = array( 'iRelated' => 'Components_Entite_View_ViewRelated_library_Service',
						  'iSearch' => 'Components_Entite_View_Search_library_SearcherUsages',
						   'iFormDb'=> 'FormDb_Connect_FormDbUsages'
		);
		
		
		try {
			
			
				return new $servive [ $name ] ();
			
		} catch ( Exception $ex ) {						
				
			
				Throw new Components_System_library_Exceptions_noServiceFound('nie Znaleziono servisu');
		}
		
	}

}

?>