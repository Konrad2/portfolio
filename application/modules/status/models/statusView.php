<?php

/**
 * statusView
 * 
 * @author Konrad
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class statusView extends abstract_viewModel {
	/**
	 * The default table name 
	 */
	protected $_name = 'status';
	
	public function init(){
		
		parent::init();
		$this->foreignKey = 'id_status';		
	}

}

