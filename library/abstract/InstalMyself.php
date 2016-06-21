<?php
/**
 * klasa s�urzy do instalacji oraz inicjacji modu�u
 * @author Konrad
 *
 */
abstract class abstract_InstalMyself implements istart
{	
	/**
	 * nazwa modu�u. Musi zawiera� nazw� danego modu�u tak� sam� jak nazwa katalogu g��wnego modu�u
 	 * @var string
	 */
	protected $name;
	
	/**
	 * Instaluje modu�. Dodaje do pliku config oraz inicjuje. Inicjacja nastepuje poprzez wywo�anie metody start.
	 * Aby doda� jakie� czynno�ci podczas inicjacji modu�u nalerzy nadpisa� metod� start
	 * a nast�pnie wywo�a� procedur� rodzica poprzez wywo�anie parent::start().
	 */
	public function instalMy()
	{
		$this->addToConfig();		
		$this->start();
	}
	
	/**
	 * deinstaluje modu�
	 */
	public function deinstal()
	{
		$this->stop();
		$this->rmFromconfig();
	}
	
	/**
	 * dodaje do pliku config 
	 */
	protected function addToConfig()
	{
		$xmlFile = file_get_contents("../application/config/config.xml");
		$xml = new SimpleXMLElement($xmlFile);
			
		$i = count($xml->modules->mod);	
		$xml->modules->addChild('mod');
		
		$xml->modules->mod[$i]->addChild('name',$this->name);
		$xml->asXML("../application/config/config.xml");
		
		echo '<br/>Pomy��nie dodano '.$this->name.' do config.xml<br/>';
	}
	
	/**
	 * usuwa z pliku config
	 */
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
	
	/**
	 * Pusta procedura
	 */
	protected function addToReg()
	{
		
	}
	
	/**
	 * usuwa namespace o nazwie takiej samej jak nazwa modu�u
	 */
	protected function rmFromReg()
	{
		$s = new Zend_Session_Namespace($this->name);
		unset($s);
	}
	
	/**
	 * Inicjuje modu�. Sprawdza czy plik config.xml istnieje w module. 
	 */
	public function start()
	{
		if (file_exists('../application/modules/'.$this->name.'/config.xml'))
		{
			//	$config = new Zend_Config_Xml('../application/modules/'.$this->name.'/config.xml','zendConfig');
			try 
			{
				$config = new Zend_Config_Xml('../application/modules/'.$this->name.'/config.xml','contract');
		
				if(isset($config->contract))
					foreach($config->contract->ToArray() as $key=>$v)
					{					
						$connector = new connector();
						$connector->set('reg',array('contract',$key,$v));						
					}
			}	  
			catch(Expection $ex)
			{
				echo 'b��d w metodzie start modu�u'.$this->name.'<br />';
				echo $ex.getMessage();
			}					
		}
	}	
	
	/**
	 * zatrzymuje modu�. Domy�lnie pusta metoda.
	 */
	public function stop()
	{}
//	public function destroyMod();
//	public function saveChangeToConfig();
}
?>