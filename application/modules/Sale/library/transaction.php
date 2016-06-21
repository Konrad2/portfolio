<?php
class transaction
{
	public function makeOrder($data,$id_products)
	{
		require('../application/modules/sale/models/order.php');
		require('../application/modules/sale/models/order_things.php');
		require('../application/modules/sale/models/data_to_send.php');

		$ns = new Zend_Session_Namespace('db');

		$t_o = new order_things($ns->db);
		$dts = new data_to_send($ns->db);
		$ord = new order($ns->db);

		$r = $ord->createRow();
		$r->save();
		echo 'order id='.$r['id'];

		$t_o->addRow($id_products,$r['id']);

		$dts->addRow($data,$r['id']);
	}
}
?>