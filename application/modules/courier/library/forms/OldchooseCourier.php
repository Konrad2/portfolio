<?php
/**
 * 
 * @author Konrad
 * @package Courier
 *
 */   
class OldchooseCourier extends forms_factoryClient
{
	public function init()
	{
		require_once('../application/modules/courier/models/courier.php');
		
		$t = new courier();
		
		$sel= new Zend_Form_Element_Select('courier');
		$sel->setLabel('Kurier')
			->setRequired(true);
		
		foreach($t->fetchAll() as $r)
		{
			$sel->addMultiOption($r->id, $r->name);
		}
		$this->addElement($sel);
	}
}
?>