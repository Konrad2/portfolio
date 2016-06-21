<?php
/**
 * Klasa umorzliwia odwo³ywanie siê do podstawowych informacji o module.
 * reprezêtuje jeden Modu³ a raczej informacje o nim.
 * @author Konrad
 * @package System
 */
class system_moduleConfigElement
{
	/**
	 * nazwa modu³u, sekcji w jakiej jest zapisany.
	 * @var string
	 */
	private $name;
	/** 
	 * @var Zend_config_Element Dane o module.
	 */
	private $mod;
	/**
	 * Tworzy instancje klasy z elementu Zend_Config_Xml ( lepiej z  config ).
	 * @param Zend_Config_Xml $elem obiekt 
	 * @param string $modName nazwa modu³u 
	 */
	public function __construct($elem, $modName)
	{
		if ( is_string($modName) )
		{
			$this->name = $modName;
			$this->mod = $elem;
		}
		else 
			 throw new Exception('Z³y parametr przekazany jako nazwa modu³u. Nie string');
	}
	
	/**
	 * @return string zwraca dane z elemêtu side. Wartoœ mówi po której stronie ma zostaæ wyœwietlony modu³.
	 */
	public function getSide(){
		
		return $this->mod->side;
	}
	/**
	 * Zwraca nazwê modu³u (tak¹ jak nazwa katalogu w kturym siê znajduje
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Ustawia nazwê modu³u. 
	 * @param string $name nazwa modu³u
	 */
	public function setName( $name )
	{
		
	}
	
	/**
	 * Pobiera nazwê modu³u tak¹ jaka ma byæ wyœwietlona urzydkownikowi
	 * np. nazwa dla urzydkownika modu³u admin to panel administracyjny.
	 */
	public function getOutput()
	{
		return $this->mod->output;
	}
	
	/**
	 * Nadaje nazwê ktura ma siê pokazywaæ urzydkownikowi 
	 * @param $name
	 */
	public function setOutput($name)
	{
		
	}

	/**
	 * Zwraca miejsce wyœwietlania siê modu³u w g³ównym layot-cie
	 * np. left, right(powinien raczej jakiœ obiekt)
	 */
	public function getWhereDisplay()
	{
		
	}
	
	/**
	 * Ustawia gdzie ma byæ wyœwietlane.
	 * @param Jakiœ param :) $where
	 */
	public function setWhereDisplay( $where )
	{
		
	}	
	
	/**
	 * Ustawia wartoœæ podan¹ w parametrze $what na wartoœæ podan¹ w elemencie $value  
	 * @param unknown_type $what co ma byæ ustawione
	 * @param unknown_type $value wartoœæ jaka ma byæ ustawiona
	 */
	public function set($what, $value)
	{
		
	}
	
	/**
	 * Zwraca wartoœ znajduj¹c¹ siê pod kluczem podanym w $wath
	 * @param $what
	 */
	public function get($what)
	{
		
	}
}

?>
