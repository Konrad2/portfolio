<?php

class Class_Resource_layout extends Zend_Application_Resource_ResourceAbstract {
	
	public function init(){
		
			$options = array(
	    'layout'     => 'layout',
	    'layoutPath' => '../library/script/layouts',
	   // 'layoutPath' => '../application',
	    'contentKey' => 'contentt',           // ignored when MVC not used
			);

		Zend_Layout::startMvc($options);
		
	}

}

?>