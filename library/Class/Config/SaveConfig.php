<?php
/**
 * Klasa dziedziczy z Zend_Config_Xml jednak po odwo�aniu si� do nieistniej�cego pola, wyj�tek nie jest wyrzucany. 
 * @author Konrad
 * @category Config
 */
class Class_Config_SaveConfig extends Zend_Config_Xml {

	
	protected $_patch;
	
	/**
	 * @var string sekcja pod kt�r� zapisane s� modu�y w pliku konfiguracyjnym.
	 */
	protected $_section ;
	
	
	public function __get($string) {

		return null;
		
	}
	
	
	 public function __construct($xml, $section = null, $options = false) {
		
		try{
			
			parent::__construct($xml, $section, $options);
			
		} catch( Exception $ex ) {
			
		}
	}
	
	
	public function setPatch( $patch ) {		
		
		
		$this->_patch = $patch;
				
	}
	
	
	public function setSection($section) {
		
		
		$this->_section = $section ;		
		
	}

	/**
	 * Wypisuje linki z podanej sekcji z danego modu�u
	 * @param unknown_type $module
	 * @param unknown_type $section
	 */
	/*public static function outputLink( $module, $section ){

		$SaveConfig = new Zend_Config_Xml( '../application/modules/'. $module .'/SaveConfig.xml', $section );

		foreach ( $SaveConfig as $menu => $v )
		{
			//echo $menu.'<br/>';
			echo $v->getValue().'<br/>';
		}
	}
	*/
}
?>