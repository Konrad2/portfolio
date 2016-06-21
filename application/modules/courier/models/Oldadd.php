<?php
/**
 * 
 * @author Konrad
 * @package Courier
 *
 */

class Oldadd extends Zend_Db_Table_Abstract
{	
	protected $_name;
	
	protected function _setupTableName()
    {
        $this->_name = 'courier';
        parent::_setupTableName();
    }

}