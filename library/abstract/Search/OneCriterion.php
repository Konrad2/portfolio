<?php

/** 
 * @author Konrad
 * 
 * 
 */
class abstract_Search_OneCriterion extends abstract_Search_ManyCriterions  {
	
	protected $_key;
	
	public function addParam($param){
		
		$this->clear();
		
		$this->add($param,$this->_key);
	}
}

?>