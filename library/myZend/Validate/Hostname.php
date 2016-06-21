<?php

class myZend_Validate_Hostname extends Zend_Validate_Hostname {

	  public function __construct($options = array()){
	  	
		  $this->setMessages(array(
	        self::INVALID                 => "Niepoprawny typ, wartość powinna być tekstem",
	        self::IP_ADDRESS_NOT_ALLOWED  => "'%value%' poprawny adres IP, IP nie jest dozwolony",
	        self::UNKNOWN_TLD             => "'%value%' poprawny adres DNS nazwa hosta nie można odnaleźć na liście TLD",
	        self::INVALID_DASH            => "'%value%' poprawny adres DNS, zawiera kreskę w nieprawidłowym położeniu",
	        self::INVALID_HOSTNAME_SCHEMA => "'%value%' poprawny adres DNS, nie można przyrównać do schematu TDU '%tld%'",
	        self::UNDECIPHERABLE_TLD      => "'%value%' poprawny adres DNS, nie można wyodrębnić część TLD",
	        self::INVALID_HOSTNAME        => "'%value%' nie pasuje do oczekiwanej struktury adresu DNS",
	        self::INVALID_LOCAL_NAME      => "'%value%' niepoprawna nazwa lokalna sieć",
	        self::LOCAL_NAME_NOT_ALLOWED  => "'%value%' poprawna nazwa sieci lokalnej, jednak adresy lokalne są niedopuszczalne",
	        self::CANNOT_DECODE_PUNYCODE  => "'%value%' poprawny adres DNS, biorąc pod uwagę zapis punycode nie mogą być dekodowane",
	    ));
    }
}

?>