<?php
/**
 * klasa s³urzy do instalacji oraz inicjacji modu³u
 * @author Konrad
 *
 */
abstract class abstract_InstalMyself implements istart
{	
	/**
	 * nazwa modu³u. Musi zawieraæ nazwê danego modu³u tak± sam± jak nazwa katalogu g³ównego modu³u
 	 * @var string
	 */
	protected $name;
	
	/**
	 * Instaluje modu³. Dodaje do pliku config oraz inicjuje. Inicjacja nastepuje poprzez wywo³anie metody start.
	 * Aby dodaæ jakie¶ czynno¶ci podczas inicjacji modu³u nalerzy nadpisaæ metodê start
	 * a nastêpnie wywo³aæ procedurê rodzica poprzez wywo³anie parent::start().
	 */
	public function instalMy()
	{
		$this->addToConfig();		
		$this->start();
	}
	
	/**
	 * deinstaluje modu³
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
		
		echo '<br/>Pomy¶›nie dodano '.$this->name.' do config.xml<br/>';
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
	 * usuwa namespace o nazwie takiej samej jak nazwa modu³u
	 */
	protected function rmFromReg()
	{
		$s = new Zend_Session_Namespace($this->name);
		unset($s);
	}
	
	/**
	 * Inicjuje modu³. Sprawdza czy plik config.xml istnieje w module. 
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
				echo 'b³±d w metodzie start modu³u'.$this->name.'<br />';
				echo $ex.getMessage();
			}					
		}
	}	
	
	/**
	 * zatrzymuje modu³. Domy¶lnie pusta metoda.
	 */
	public function stop()
	{}
//	public function destroyMod();
//	public function saveChangeToConfig();
}
?>