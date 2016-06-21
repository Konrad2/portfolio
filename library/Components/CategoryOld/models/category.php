<?php

/** 
 * @author Konrad
 * @package Category
 * 
 * 
 */
class category extends abstract_formDbModelParent {

	public function init(){
		
		$this->foreignKey = 'id_subcategory';
		
		
	}
	
	public function isCorect($id){
		
		return true;//if ($this->find( $id ));		
	}
	
}

?>