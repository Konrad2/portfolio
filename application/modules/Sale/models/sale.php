<?php

/**
 * 
 * @author Konrad
 * @package Sale
 *
 */
class sale extends abstract_formDbModelParent
{
	protected $_name = 'order';
	protected $_dependentTables = array('orderThings');
	
	protected $_referenceMap    = array(
        
        'orderThings' => array(
            'columns'           => array('id'),
            'refTableClass'     => 'orderThings',
            'refColumns'        => array('order_id')
        )
    );

		
	public function get($id)
	{  
		require('../application/modules/things/models/things.php');				
		require('../application/modules/sale/models/orderThings.php');
		
		$r = parent::fetchRow($id);
		return $r->findManyToManyRowset('things', 'orderThings');
	}
	
	public function makeOrder($data,$id_products)
	{			
		require_once('../application/modules/Sale/models/order.php');
		require_once('../application/modules/Sale/models/orderThings.php');
		require_once('../application/modules/Sale/models/data_to_send.php');

		$ns = new Zend_Session_Namespace('db');

		$t_o = new orderThings($ns->db);
		$dts = new data_to_send($ns->db);
		$ord = new order($ns->db);

		$r = $ord->createRow();
		
		
		date_default_timezone_set('Europe/London');
		
		$date = getdate();	

		
		$r->data =$date['year'].'-'.$date['mon'].'-'.$date['mday'];
		 
		$r->save();		
	
		$t_o->addRow($id_products,$r['id']);
		$dts->addRow($data,$r['id']);
		
		return $r;		
	}
	
	
	public function changeCourier(Zend_Db_Table_Row $parentRow, $id_courier){
		
		$ad =  Zend_Registry::get('adapter');
		$select = $this->select();
		$select->from('order');
		$select->where( 'id ='.$parentRow->id );
		
		$row = $this->fetchRow($select);
		$row->id_courier = $id_courier;
		$row->save();
	}
	
	

}
