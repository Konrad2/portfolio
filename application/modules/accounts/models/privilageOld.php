<?php

/**
 * privilageOld
 * 
 * @author Mare^(Imbrum
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class privilageOld extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'privilageOld';
	//protected $_dependentTables = 'account';
	protected $_dependentTables = 'password';
	/**
	protected $_referenceMap    = array(
        'account' => array(
            'columns'           => 'id',
            'refTableClass'     => 'account',
            'refColumns'        => 'id_privilage'));
*/
}