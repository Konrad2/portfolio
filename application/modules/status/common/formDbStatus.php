<?php

/** 
 * @author Konrad
 * @status
 * 
 */
class formDbStatus extends abstract_formDbClient {
	
	public function init(){
		
		$this->patchToModel = '../application/modules/status/models/statusFormDb.php';
		$this->modelName = 'statusFormDb';

		$this->foreignKey = 'id_status';
	}

}

?>