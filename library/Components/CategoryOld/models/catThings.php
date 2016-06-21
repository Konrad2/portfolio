<?php

/**
 * catThings
 * 
 * @author Konrad
 * @package Category
 */

require_once 'Zend/Db/Table/Abstract.php';

class catThings extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'category_things';
	
	 protected $_referenceMap    = array(
        'things' => array(
            'columns'           => array('id_thing'),
            'refTableClass'     => 'things',
            'refColumns'        => array('id')										 
        ),
        'category' => array(
            'columns'           => array('id_category'),
            'refTableClass'     => 'category',
            'refColumns'        => array('id')
        )
    );



	public function addRow($data,$order_id)
	{
		foreach ($data as $pr)
		{
		//coud be ->addRow($basket)
			$o = $this->createRow();
			$o['id_thing'] = $pr;
			$o['id_category'] = $order_id;
			$o->save();
		}
	}
}