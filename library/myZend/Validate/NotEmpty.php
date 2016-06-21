<?php
class myZend_Validate_NotEmpty extends Zend_Validate_NotEmpty{
	
	  public function __construct($options = array())
	   {
	  	
		  $this->setMessages(array(
		  self::IS_EMPTY => "Pole wymagane, nie może być puste",
      	  self::INVALID  => "Niepoprawny typ, wartość powinna być float, string, array, boolean lub integer",
		  ));
	   }

}
