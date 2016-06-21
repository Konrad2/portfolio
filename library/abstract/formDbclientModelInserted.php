<?php

abstract class abstract_formDbModelInsertedClient extends abstract_formDbModelClient {

	public function doInsert($row = null, $data = null, $values = null, $foreignKey = null){
		
	
	
		$newRow = $this->createRow();
		
		foreach ($newRow->toArray() as $key => $v){

			$newRow[$key] = $data[$key];
		}
		
		$newRow->save();
		
		return $newRow;
	
	
	
	
		$sub = $data->getSubForms();
//		$t = $sub['child']->getValues();
		$t = $sub['child']->getValue($foreignKey);
		$t = $data->get();
		$z = $t->getValue($foreignKey);
		
		if ($z != null)
		{
		
			$query = $this->select()->from($this->_name, 'count(*)as count');		
			
			$query->where( $this->getAdapter()->quoteInto('id = ?', $z )) ;// $foreignKey]) );
			
	//		$newRow = $this->fetchAll($query);
			$newRow = $this->fetchRow($query);	
			
			$count = $newRow['count'];		
			
			
	
			if($count == 1)
			{
				//$row[$foreignKey] = $data[$foreignKey];	
				$row[$foreignKey] = $t->getValue($foreignKey);	
	
				//$row->save();
				
				return $row;
			}
			else
			{
				echo 'nie znaleziono rekordu'.$foreignKey;
			}
		}
		else
		{
			
		}
	}
}

?>