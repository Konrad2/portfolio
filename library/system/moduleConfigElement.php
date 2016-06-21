<?php
/**
 * Klasa umorzliwia odwo�ywanie si� do podstawowych informacji o module.
 * reprez�tuje jeden Modu� a raczej informacje o nim.
 * @author Konrad
 * @package System
 */
class system_moduleConfigElement
{
	/**
	 * nazwa modu�u, sekcji w jakiej jest zapisany.
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
	 * @param string $modName nazwa modu�u 
	 */
	public function __construct($elem, $modName)
	{
		if ( is_string($modName) )
		{
			$this->name = $modName;
			$this->mod = $elem;
		}
		else 
			 throw new Exception('Z�y parametr przekazany jako nazwa modu�u. Nie string');
	}
	
	/**
	 * @return string zwraca dane z elem�tu side. Warto� m�wi po kt�rej stronie ma zosta� wy�wietlony modu�.
	 */
	public function getSide(){
		
		return $this->mod->side;
	}
	/**
	 * Zwraca nazw� modu�u (tak� jak nazwa katalogu w kturym si� znajduje
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Ustawia nazw� modu�u. 
	 * @param string $name nazwa modu�u
	 */
	public function setName( $name )
	{
		
	}
	
	/**
	 * Pobiera nazw� modu�u tak� jaka ma by� wy�wietlona urzydkownikowi
	 * np. nazwa dla urzydkownika modu�u admin to panel administracyjny.
	 */
	public function getOutput()
	{
		return $this->mod->output;
	}
	
	/**
	 * Nadaje nazw� ktura ma si� pokazywa� urzydkownikowi 
	 * @param $name
	 */
	public function setOutput($name)
	{
		
	}

	/**
	 * Zwraca miejsce wy�wietlania si� modu�u w g��wnym layot-cie
	 * np. left, right(powinien raczej jaki� obiekt)
	 */
	public function getWhereDisplay()
	{
		
	}
	
	/**
	 * Ustawia gdzie ma by� wy�wietlane.
	 * @param Jaki� param :) $where
	 */
	public function setWhereDisplay( $where )
	{
		
	}	
	
	/**
	 * Ustawia warto�� podan� w parametrze $what na warto�� podan� w elemencie $value  
	 * @param unknown_type $what co ma by� ustawione
	 * @param unknown_type $value warto�� jaka ma by� ustawiona
	 */
	public function set($what, $value)
	{
		
	}
	
	/**
	 * Zwraca warto� znajduj�c� si� pod kluczem podanym w $wath
	 * @param $what
	 */
	public function get($what)
	{
		
	}
}

?>
