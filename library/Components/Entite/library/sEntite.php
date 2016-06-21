<?php

class library_sEntite {
	
	
	public function getEntite(int $id ) {
		
		
		try{
			
			$result = new Components_Entite_library_Entite($id);
			
		}
		catch{
			
		}
	}
	
	
	public function isEnable() {
		
	}

}

?>