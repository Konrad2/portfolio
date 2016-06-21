<?php 
class saleIni extends abstract_InstalMyself
{	
	public function __construct()
	{					
		$this->name= 'sale';
	}
					
	public function getName()
	{
	return $this->name;
	}
	
	public function start()
	{
		parent::start();
		$ns = new Zend_Session_Namespace('reg');
		$ns->contract['cart']['sale'] = 'sale';
	/*
		echo "jest sale init";
		$config = new Zend_Config_Xml('../application/modules/sale/config.xml','connections');
		
		$connector = new connector();
		$connector->set('sale','things',$config->things);
		$connector->set('sale','cart',$config->sale);
		*/
	}

}

?>