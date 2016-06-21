<?php
/**
 * W klasie przysłaniamy konstruktor na bezaggumentowy. Do konstruktora nie podajemy wzoru jest on automatycznie tworzony.
 * @author Konrad
*@package
 */
class Class_Validators_TextBBCodePl extends Class_Validators_tekstPl {
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->setPattern('([0-9a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ \[ \] \\ ])');
		
		
		
	}

}

?>