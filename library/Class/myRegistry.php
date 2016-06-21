<?php

/**
 * Odpowiada za rejestr kturego nie ma. Do tej pory robi³ to config. Na pocz¹dku pe³ni³ jak¹œ funkcje.
 * @author Konrad
 * @package System
 */
class Class_myRegistry implements istart{
	
	public function init()
	{
		$ns = new Zend_Session_Namespace('reg');
		$modules = new Zend_Config_Xml('../application/config/config.xml', 'modules');
		//$ns->modules = $modules;
		$myConfig = new Class_Config_myConfig();
		
		$modules = $myConfig->getModules();
		
		foreach ( $modules as $m)
		{
			$ns->modules[] = serialize($m);
		} 
		
	//	$ns->modules = $modules->mod->toArray();
		/*
		$ns->modules = $modules->mod->toArray();	
		
		foreach($modules->mod as $mod)
		{
			if (isset($mod->side))
				echo $mod->side.'</br>';
		}
		*/
		
		$sets = new Zend_Config_Xml('../application/config/config.xml', 'setings');
		
		$ns->pageRank = $sets->pageRang;
		$ns->itemsCount = $sets->itemsCount;
		$ns->setExpirationSeconds = $sets->timeout;
	}
	
	public function start(){
		
		$this->init();
		
		$installer = new installer();
			
		$ns = new Zend_Session_Namespace('reg');
		$modules = $ns->modules;
		//	||zast¹pione
		//  \/

		$modules = new system_modulesConfigApi();
		
		$m = system_modulesConfigApi::getModules();
		
		foreach ($m as $mod)
		{			
			//$installer->init($mod['name']);			
			$installer->init( $mod->getName() );			
		}
	}
	
	public function refresh()
	{
		$ns = new Zend_Session_Namespace('reg');

		unset($ns->modules);		

		$this->init();		
	}

	public function get($what)
	{
		$ns = new Zend_Session_Namespace('reg');

		if ( isset($ns->$what) )
			if ( !empty($ns->$what) )
				return $ns->$what;

		return false;
	}
}
?>