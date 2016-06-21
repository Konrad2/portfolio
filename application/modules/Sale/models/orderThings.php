<?php 

/**
 * ±
 * @author Konrad
 * @package Sale
 *
 */
class orderThings extends Zend_Db_Table
{
	protected $_name = 'order_things';
	 protected $_referenceMap    = array(
        'things' => array(
            'columns'           => array('things_id'),
            'refTableClass'     => 'things',
            'refColumns'        => array('id')										 
        ),
        'sale' => array(
            'columns'           => array('order_id'),
            'refTableClass'     => 'saleView',
            'refColumns'        => array('id')
        )
    );
	
	public function addRow($data,$order_id)
	{
		foreach ($data as $pr)
		{
		//coud be ->addRow($basket)
			$o = $this->createRow();
			$o['things_id'] = $pr;//['id'];
			$o['order_id'] = $order_id;
			$o->save();
		}
	}
}
?>