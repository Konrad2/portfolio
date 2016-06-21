<?php 
class cartIni extends abstract_InstalMyself
{	
	public function __construct()
	{
		$this->name= 'cart';
	}
/*	
	public function instal()
	{					
		$this->name= 'cart';
	}
*/					
	public function getName()
	{
	return $this->name;
	}
	
	public function start() 
	{
	/*
		$ns = new Zend_Session_Namespace($this->name);
		$conf = new Zend_Config_Xml('../application/modules/'.$this->name.'/config.xml','connections');
		$ns->things = $conf->things;
		$ns->sale = $conf->sale;
		*/
	}

}

?>