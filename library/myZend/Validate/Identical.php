<?php

class myZend_Validate_Identical extends Zend_Validate_Identical{
	 public function __construct($token = null)
    {
    	parent::__construct($token);
    	
    	$this->setMessages( array(
        self::NOT_SAME      => "Pola nie są takie same",
        self::MISSING_TOKEN => 'Ddrógie pole nie zostało podane',
    ));
    	
    }
}

