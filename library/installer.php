<?php
	class installer
	{
		public function instal($name)
		{
			if(file_exists('../application/modules/'.$name.'/'.$name.'Ini.php'))
			{
				require_once('../application/modules/'.$name.'/'.$name.'Ini.php');
				
				$mod = new instal();
				//echo 'my name is'.$mod->getName().'</br>';
				$mod->instalMy();				
				$registry = new Class_myRegistry();
				$registry->refresh();
				$this->init($name);
			}
			else 
				echo 'brak pliku ../application/modules/'.$name.'/'.$name.'Ini.php'	;	
		}
		
		public function init($name)
		{
			if(file_exists('../application/modules/'.$name.'/'.$name.'Ini.php'))
			{
				require_once('../application/modules/'.$name.'/'.$name.'Ini.php');
				$name .= 'Ini';
				$modInit = new $name();
				$modInit->start();					
			}
		}
		
		public function deinstal($name)
		{
			if(file_exists('../application/modules/'.$name.'/'.$name.'Ini.php'))
			{
				require_once('../application/modules/'.$name.'/'.$name.'Ini.php');
				$name .= 'Ini';
				$module = new $name();
				$module->deinstal();

				$registry = new Class_myRegistry();
				$registry->refresh();
			}
		}
	}

?>