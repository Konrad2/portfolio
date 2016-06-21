<?php

class system_connector
{
	
	
	public function getAct($module,$controller,$action,$what)
	{
	/*
		if ( file_exists('../application/modules/'.$module.'/library/'.$module.'Reg.php') )
		{
			require_once('../application/modules/'.$module.'/library/'.$module.'Reg.php');
			
			$n = $module.'Reg.php';
			$reg = new $n();
			
			return $reg->get($controller,$action,$what)
			
			if (isset($this->ns->$n))
				if (!empty($this->ns->$n))
					return $this->ns->$n;
		}
	*/	
	$ns = new Zend_Session_Namespace($module.'Connect');
	
	if (isset($ns->$module))
			if (isset($ns->$module->$action))
						if (isset($what))
						{
							if(is_array($ns->$module->$action))
								return $ns->$module->$action[$what];
						}
						else
							return $ns->$module->$action;
	}
	
	public function getFromArray($namespace,$what)
	{
		$ns = new Zend_Session_Namespace($namespace);
		$pom = $ns;//->toArray();
	/*	
	require_once('FirePHPCore/FirePHP.class.php');
	$firephp = FirePHP::getInstance(true);
	$firephp->log( $pom->contract,'contract');
	*/
	//$firephp->table('namespace', $pom->contract);
	
		foreach($what as $x)
		{
			if (isset($pom->$x))
				$pom = $pom->$x;
			else
				return ; 
			
		}
	}	
	
	public function get($module, $param)
	{
		$ns = new Zend_Session_Namespace($module);
		return $ns->$param;		
	}
	
	public function set ($name, $what,$param)
	{
		$ns = new Zend_Session_Namespace($name);
		$ns->$what = $param;
	}
}

?>