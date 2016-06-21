<?php

class Packages_Products_model_formDb extends FormDb_Connect_models_Parent {
	
		public function doUpdate($row = null, $data = null, $values = null , $foreignKey = null) {
		
			$newRow = parent::doUpdate($row, $data, $values, $foreignKey);
			
			if (isset($data['category']) ){
				
					$newRow->id_category = $data['category'];
				} else {
					$newRow['id_category'] = null;
				}
				$newRow->save();
			
				
			return $newRow;
		}
}