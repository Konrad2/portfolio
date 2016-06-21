<?php 
class curierIni extends abstract_InstalMyself
{	
	public function __construct()
	{					
		$this->name= 'curier';
	}
					
	public function getName()
	{
	return $this->name;
	}
	
	public function start()
	{
		parent::start();
		
		
		//mo¿na wykasowaæ
		$ns = new Zend_Session_Namespace('reg');
		$ns->connections['sale']['viewlabel'] = 'courier';
	}
}

?>