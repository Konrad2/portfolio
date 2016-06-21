<?php 
class starter implements iStarter
{
	public function start()
	{
		$this->initAuth();//zrobić z tego komponent					
		$this->initDB();
		$this->initModules();	
		$this->initModReg();		
	}
	/*
	public function instal($name)
	{
			if (file_exists('../application/modules/'.$name.'/'.$name.'.php'))
			{
				require_once('../application/modules/'.$name.'/'.$name.'.php');
				$instaler = new $name();
				//$instaler->addToConfig();
				//$instaler->addToReg();					
				$instaler->instal();	
				
				$this->initModulesReg();
				return null;
			}
			else
			{
				return 'cant find init class';
			}
		
	}
	
	public function deinstal($name)
	{
		if (file_exists('../application/modules/'.$name.'/'.$name.'.php'))		
		{
			require_once('../application/modules/'.$name.'/'.$name.'.php');			
			$instaler = new $name();
			//iinstaler ->deinstal('view');
			//$this->rmFromConfig($name);
			$instaler->destroy();				
			
			//$ini = new starter();
			$this->initModulesReg();
			return null;
		}
		else
		{		
			return 'nie znaleziono pliku nazwa_modułu.php w głównym katalogu modułu';			
		}
	}
	*/
	
	
	public function stop()
	{}
	
	private function initAuth()
	{
		Zend_Loader::loadClass('Zend_Auth');
		$authSession = new Zend_Session_Namespace('Zend_Auth');
  		$authSession->setExpirationSeconds(3600); 
	}
	
	private function initDB()
	{
		$ns = new Zend_Session_Namespace('db');
		//$registry = Zend_Registry::getInstance();
		$config = new Zend_Config_Xml('../application/config/config.xml', 'general');			
		//Zend_Registry::set('config', $config);		
		// setup database 		
		$db = Zend_Db::factory($config->db->adapter,
		$config->db->config->toArray() );
		Zend_Db_Table_Abstract::setDefaultAdapter($db); 
		$ns->db = $db;	
	}
	
	public function initModules()
	{
		$registry = new Class_myRegistry();
		
		$registry->init();		
	}
	
	private function initModReg()
	{
		$ns = new Zend_Session_Namespace('reg');			 		
		$modules = 	$ns->modules;		
		
		foreach ($modules as $mod)
		{					
			//klasa init
			if(file_exists('../application/modules/'.$mod['name'].'/'.$mod['name'].'.php'))
			{
				require_once('../application/modules/'.$mod['name'].'/'.$mod['name'].'.php');
				$modInit = new $mod['name']();
				$modInit->initMod();					
			}	
			else
				echo 'plik../application/modules/'.$mod['name'].'/'.$mod['name'].'.php nie istnieje';
		}		
	}
	/*
	private function rmFromConfig($name)
	{
		$xmlFile = file_get_contents("../application/config/config.xml");
		$xml = new SimpleXMLElement($xmlFile);
		//$xml->modules->addChild('mod','konrad');	
		$value = $name;
		for ($i = 0, $count = count($xml->modules->mod); $i < $count; $i++)
		{echo 'czytam '.$xml->modules->mod[$i].'<br/>';
			if ($xml->modules->mod[$i]['name'] == $value)
				unset($xml->modules->mod[$i]);
		}
		
		$xml->asXML("../application/config/config.xml");
	}
	*/
	

	
}
?>