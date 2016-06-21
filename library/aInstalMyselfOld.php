<?php
abstract class aInstalMyself implements istart
{	
	protected $name;
	
	public function instalMy()
	{
		echo"INSTALIJE...";
		$this->addToConfig();		
		$this->start();//czy wywoła rodzica??
	}
	
	public function deinstal()
	{
		$this->stop();
		$this->rmFromconfig();
	}
	
	protected function addToConfig()
	{
		$xmlFile = file_get_contents("../application/config/config.xml");
		$xml = new SimpleXMLElement($xmlFile);
			
		$i = count($xml->modules->mod);	
		$xml->modules->addChild('mod');	 
		
		$xml->modules->mod[$i]->addChild('name',$this->name);
		$xml->asXML("../application/config/config.xml");
		
		echo '<br/>Pomyśnie dodano '.$this->name.' do config.xml<br/>';
	}
	protected function rmFromConfig()
	{
		$xmlFile = file_get_contents("../application/config/config.xml");
		$xml = new SimpleXMLElement($xmlFile);
		
		$value = $this->name;
		for ($i = 0, $count = count($xml->modules->mod); $i < $count; $i++)
		{			
			if ($xml->modules->mod[$i]->name == $value)
			{				
				unset($xml->modules->mod[$i]);
			}
		}
		
		$xml->asXML("../application/config/config.xml");
	}
	protected function addToReg()
	{
		
	}
	protected function rmFromReg()
	{
		$s = new Zend_Session_Namespace($this->name);
		unset($s);
	}
	public function start()
	{}
	
	public function stop()
	{}
//	public function destroyMod();
//	public function saveChangeToConfig();
}
?>