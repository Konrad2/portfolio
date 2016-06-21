<?php

	class instaler
	{
		public function instal($module)
		{
			$module->initMod();
			$registry = new Class_myRegistry();
			$registry->refresh();			
		}
		
		public function init($name)
		{
			if(file_exists('../application/modules/'.$name.'/'.$name.'.php'))
			{
				require_once('../application/modules/'.$name.'/'.$name.'.php');
				$modInit = new $name();
				$modInit->initMod();					
			}
			else
				echo 'plik../application/modules/'.$mod['name'].'/'.$mod['name'].'.php nie istnieje';
		}
		
		public function deinstal($module)
		{
			$module->deinstal();
			$registry = new Class_myRegistry();
			$registry->refresh();			
		}
	}

?>