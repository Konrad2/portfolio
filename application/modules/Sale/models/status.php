<?php

class status extends Zend_Db_Table {

	//protected $_dependentTable = array('order');
	
	
	
	protected function _setupTableName()
    {
        $this->_name = 'status';
        parent::_setupTableName();       
    }
}

?>