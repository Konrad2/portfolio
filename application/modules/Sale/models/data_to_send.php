<?php

/**
 * ±
 * @author Konrad
 * @package Sale
 *
 */
class data_to_send extends Zend_Db_Table
{
	public function addRow($data,$order_id)
	{
		$r = $this->createRow();	
		
		//$keys = $this->describeTable();
		
		foreach ($data as $col)
		{
			echo $col.'<br/>';
		}
		
		foreach ($this->_cols as $col)
		{		
			if ((isset($data[$col]) )&& ($col !== 'id'))
			{
				$r[$col] = $data[$col];
				echo $col.'<br/>';
			}
		}
		$r['order_id'] = $order_id;
		$r->save();
		
		return $r['id'];
		//$r->street = $data['street'];		
	}
}
?>