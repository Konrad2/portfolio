<?php
/**
 * Api do pracy z informacjami o modu³ach.
 * implemêtuje us³ugi dziêki kturym mo¿emy odwo³ywaæ siê do informacji o modu³ach takich jak: nazwa modu³u, nazwa do wy¶wietlania urzytkownikowi,
 * ...
 * @author Konrad
 * @package System
 */
class system_modulesConfigApi
{
	/**
	 * @var string sekcja pod któr± zapisane s± modu³y w pliku konfiguracyjnym.
	 */
	protected $section = 'modules';
	/**
	 * Koncepj± klasy jest ¶wiadczenie us³ug zapewniaj±cych dane o modu³ach.
	 * 
	 * Karzdy element reprezentuje jeden zainstalowany modu³.
	 * @param string Œcie¿ka do pliku konfiguracyjnego.
	 * @param string sekcja w kturen zapisane s± informacje o modu³ach.
	 * @return array Zwraca tablice elemêtów typu configModulesElement.
	 */
	public function getModules()
	{
		$patchToConfigFile = Class_system::patchToConfig();		
		
		$config = new Zend_Config_Xml( $patchToConfigFile, $this->section );
		
		$modules = array();
		
		/**
		 * Tworzy elemêty typu system_configModulesElement (g³ówna czê¶æ klasy).
		 */
		foreach ($config  as $key => $c )
		{
			$modules[] = new system_moduleConfigElement($c,$key);
		}

		return $modules;
	}
		
}
?>