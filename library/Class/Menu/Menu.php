<?php

/** 
 * @author Konrad
 * @package Menu
 * 
 */
class Class_Menu_Menu {
	
	
	private $__section;
	
	private $__patch;
	
	private $__config;
	
	
	public function __construct(){
		
		
		$this->__config = new Class_Config_myConfig();
		
	}

	
	/**
	 * Generuje Menu. wogule nie powinna istrnieć procedura
	 * Menu generuje si� na podstawie pliku konfiguracyjnego w module.
	 * 
	 * @param $param1
	 * @param $param2
	 * @param $param3
	 */
	 
	public function renderMenu($param1, $param2, $param3) {
			
		
		// wogule nie powinna istrnie� procedura
		
		throw new exception('dasf');
		
		$result = $this->__config->outputLink ( $param1, $param2, $param3 );
		
		
		foreach ( $result as $link ) {			
			
			echo $link;
			
		}			
	}
	
	
	public function setPatch( $patch ) {
		
		
		$this->__config->setPatch( $patch );
		
	}
	
	
	public function setSection($section) {
		
		
		$this->__config->setSection( $section );
		
	}
	
	
	/**
	 *  Tworzy menu na podstawie pliku konfiguracyjnego.
	 * @param string $patch 
	 * @param $section
	 */
	
	protected function  getMenu( $patch,  $section ) {
		
	//	try {
			
				if ( file_exists ( $patch ) ) {
																																				  
					$page = Class_Navigation_Navigation::createFromFile( $patch, $section );
					
				return $this->view->navigation()->menu()->render( $page ) ;
			//	return $page ;
						
			}

	//	} catch(  Exception $ex ){
			
			echo 'Blad viewController->getrMenu';
			
	//	}
	
	}
	
}

?>