<?php
/**
 * 
 * @author Konrad
 * @package Courier
 *
 */

class courierInsert extends abstract_formDbModelClient//extends abstract_factoryModelClient
{	
	protected function _setupTableName()
    {
        $this->_name = 'courier';
        parent::_setupTableName();
    }
    
	/*
	public function doInsert($row,$data)
	{
		$query = $this->select()->from($this->_name, 'count(*)as count');
		$query->where( $this->getAdapter()->quoteInto('id = ?', $data['id_courier']) );
		
		$newRow = $this->fetchAll($query);
		
		$count = $newRow[0]['count'];

		if($count == 1)
		{
			$row['id_courier'] = $data['id_courier'];	

			$row->save();
			
			return true;
		}
		else 
		{
			throw new Exception ( "kurier nie dodany count != 1. CourierInsert->doInsert");
			return false;
		}
	}
	*/
}