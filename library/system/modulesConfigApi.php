<?php
/**
 * Api do pracy z informacjami o modu�ach.
 * implem�tuje us�ugi dzi�ki kturym mo�emy odwo�ywa� si� do informacji o modu�ach takich jak: nazwa modu�u, nazwa do wy�wietlania urzytkownikowi,
 * ...
 * @author Konrad
 * @package System
 */
class system_modulesConfigApi
{
	/**
	 * @var string sekcja pod kt�r� zapisane s� modu�y w pliku konfiguracyjnym.
	 */
	protected $section = 'modules';
	/**
	 * Koncepj� klasy jest �wiadczenie us�ug zapewniaj�cych dane o modu�ach.
	 * 
	 * Karzdy element reprezentuje jeden zainstalowany modu�.
	 * @param string �cie�ka do pliku konfiguracyjnego.
	 * @param string sekcja w kturen zapisane s� informacje o modu�ach.
	 * @return array Zwraca tablice elem�t�w typu configModulesElement.
	 */
	public function getModules()
	{
		$patchToConfigFile = Class_system::patchToConfig();		
		
		$config = new Zend_Config_Xml( $patchToConfigFile, $this->section );
		
		$modules = array();
		
		/**
		 * Tworzy elem�ty typu system_configModulesElement (g��wna cz�� klasy).
		 */
		foreach ($config  as $key => $c )
		{
			$modules[] = new system_moduleConfigElement($c,$key);
		}

		return $modules;
	}
		
}
?>