<?php

 
/**
 * W klasie przysłaniamy konstruktor na bezaggumentowy. Do konstruktora nie podajemy wzoru jest on automatycznie tworzony.
 * @author Konrad
 *@package Validators
 */
class Class_Validators_atLeastOneNumber extends Zend_Validate_Regex {
	
	
	public function __construct( ) {

		parent::__construct( '/[0-9]{1,}/');
		
		$this->setMessage("Hasło musi posiadać przynajmniej jedną liczbę");				
	}

}