<?php

/**
 * W klasie przysłaniamy konstruktor na bezaggumentowy. Do konstruktora nie podajemy wzoru jest on automatycznie tworzony.
 * @author Konrad
 *@package Validators
 */
class Class_Validators_tekstPl extends Zend_Validate_Regex {
	
	
	public function __construct( ) {
		
		//parent::__construct( '([a-z A-Z żŻŹźćĆńŃóÓś(),\. 0-9 \s \w  \d])');
		parent::__construct( '/^([a-z A-Z żŻŹźćĆńŃóÓśĄąĘę(),\. 0-9 \s  \d])*$/');
		
		//\w matches letters, digits and underscore; together with the dot and dash they form a character class
		$this->setMessage("Wprowadzono nieprawidłowe znaki. Dozwolone są liczby, litery oraz \"(\", \")\", \".\", \",\"");
				
	}

}

