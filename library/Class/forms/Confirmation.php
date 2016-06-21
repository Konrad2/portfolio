<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_forms_Confirmation  {

	protected $formNo;
	protected $formYes;
	
	public function __construct(){
				
		$this->formNo = new Class_forms_No();
		$this->formYes = new Class_forms_Yes();
	}
	
	/**
	 * Wy�wietla form�.
	 */					
	public function escape(){
		
		echo $this->formNo;
		echo $this->formYes;		
	}
	
	/**
	 *  
	 * @param unknown_type $request
	 * @return true je�li urzytkownik zatwierdzi�, false w przeciwnym wypadku.
	 */
	public function getValue($request){	
		
		return ($request->getParam('answer') ==='Tak') ? true : false;		
	}
}

?>