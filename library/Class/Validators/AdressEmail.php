<?php

class Class_Validators_AdressEmail extends Zend_Validate_EmailAddress {
	
	 public function __construct($options = array())
    {
    	parent::__construct($options = array());  
    
	  	$this->_messageTemplates = array(
	        self::INVALID            => "Niepoprawny typ, wartość powinna być ciągiem znaków alfanumerycznych",
	        self::INVALID_FORMAT     => "'%value%' nie jest poprawnym formatem adresu email, prawidłowy typ jest następujący local-part@hostname",
	        self::INVALID_HOSTNAME   => "'%hostname%' niewłaściwa nazwa host dla ddresu '%value%'",
	        self::INVALID_MX_RECORD  => "'%hostname%' niepoprawna vartość MX w adresie '%value%'",
	        self::INVALID_SEGMENT    => "'%hostname%' Niewłaściwy zakres adresu. Adres '%value%' powinien korzystać z publicznych adresów.",
	        self::DOT_ATOM           => "'%localPart%' nie można wykonać sprawdzania adresu, dot-atom format",
	        self::QUOTED_STRING      => "'%localPart%' niemożna porównać adresu, quoted-string format",
	        self::INVALID_LOCAL_PART => "'%localPart%' niewłaściwa część local w adresie '%value%'",
	        self::LENGTH_EXCEEDED    => "'%value%' niewłaściwa długość adrtesu",
    );
    }
}

