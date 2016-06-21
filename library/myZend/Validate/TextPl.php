<?php

class myZend_Validate_TextPl extends Zend_Validate_Regex{
	
	public function __construct($pattern = null){
		
		if ( $pattern === null )
			$pattern = '/^[a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ0-9- .,\\r\\n"]*$/';

			parent::__construct($pattern);
    }
}