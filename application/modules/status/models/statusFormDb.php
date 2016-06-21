<?php

/** 
 * @author Konrad
 * 
 * 
 */
class statusFormDb extends abstract_formDbModelClient {
	//TODO - wersja 1.0

	
	
	protected function _setupTableName()
    {
        $this->_name = 'status';
        parent::_setupTableName();
    }
    
    public function doInsert($row = null, $data = null, $values = null, $foreignKey = null){
    
    	$row['id_status'] = 1;

		$row->save();
		
		return $row;
    }
    
    
}

?>