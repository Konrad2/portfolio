<?php

class myZend_Validate_EmailAddress extends Zend_Validate_EmailAddress{

	
	 public function __construct($options = array())
    {
    	parent::__construct($options);
    
    	
    	$this->setMessages(array(
	    self::INVALID            => "Niepoprawny dane wejściowe",
        self::INVALID_FORMAT     => "'%value%' nie jest adresem e-mail, nie odpowiada formatowi local-part@hostname",
        self::INVALID_HOSTNAME   => "'%hostname%'  niepoprawny nazwa hosta dla adresu '%value%'",
        self::INVALID_MX_RECORD  => "'%hostname%'  nie wydaje się mieć prawidłową wartość MX  '%value%'",
        self::INVALID_SEGMENT    => "'%hostname%' nie jest w segmencie sieci routingu. Adres e-mail '%value%' nie powinien zawierać publicznych adresów.",
        self::DOT_ATOM           => "'%localPart%' nie mogą być porównywane z dot-atom formatem",
        self::QUOTED_STRING      => "'%localPart%' nie mogą być porównywane z quoted-string formatem",
        self::INVALID_LOCAL_PART => "'%localPart%' nieprawidłowa część adresu e-mail '%value%'",
        self::LENGTH_EXCEEDED    => "'%value%' przekracza dozwoloną długość",
        
    	));
    	
    	$this->setHostnameValidator( new myZend_Validate_Hostname );
    	
    }
}

?>