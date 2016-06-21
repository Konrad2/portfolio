<?php

class Category_addandeditController extends abstract_Controllers_addandeditController {

	public function init(){
		
		parent::init();
		$this->formDbName = 'categoryFormDb';
 		$this->patchToFormDb = '../application/modules/category/library/categoryFormDb.php';
 		
 		
	}
	
	public function build(){
		
	}	
}
?>