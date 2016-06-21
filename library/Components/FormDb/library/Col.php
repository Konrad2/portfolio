<?php
/**
 * Klasa Unknow :P
 * @author Konrad
 *
 */
class FormDb_library_Col {

	/**
	 * Pod jaką nazwą wywietlamy w backEndzie
	 * @var unknown_type
	 */
	private $__label;
	
	/**
	 * Pod jaką nazwąprzetrzymujemy w baziedanych i w formularzu.
	 * @var unknown_type
	 */
	private $__field;
	
	
	public function getLabel(){
		
		return $this->__label;
		
	}
	
	
	public function getTableName() {
		
		return $this->__field;
		
	}
	
	
	public function getFormElementName(){

			return $this->getTableName();
	}
	
}

?>