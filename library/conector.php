<?php
class conector
{
	public function get($what,$action)
	{
		$r = new Zend_Session_Namespace('connected');
		
		if ( isset($r->$what) )
		{
			return $r->$what;
		}
		else
			return array();
	}
}

?>
