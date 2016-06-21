<?php

 
/**
 * W klasie przysłaniamy konstruktor na bezaggumentowy. Do konstruktora nie podajemy wzoru jest on automatycznie tworzony.
 * @author Konrad
 *@package Validators
 */
class Class_Validators_atLeastOneBigLetter extends Zend_Validate_Regex {
	
	
	public function __construct( ) {

		parent::__construct( '/[A-Z]{1,}/');		
		$this->setMessage("Hasło musi posiadać przynajmniej jedeną durzą literę");				
	}

}