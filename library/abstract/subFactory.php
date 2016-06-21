<?php
class abstract_subFactory
{
	public function buildForm ($what)
	{
		$name = myConfig::get('things','connections',array($what));
		
		if (file_exists('../application/modules/'.$what.'/library/forms/'.$name.'.php'))
		{
			require_once(('../application/modules/'.$what.'/library/forms/'.$name.'.php'));
			$form = new $name();
		}
			
		return $form;		
	}
}
?>