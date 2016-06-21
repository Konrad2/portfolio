<?php
/**
 * 
 * @author Konrad
 * @package Pictures
 */
class Class_picture_path {

	public function __construct(){
		
	}
	
	
	private function getPatchToImage() {
		
		
		$id = $this->_request->getIntParam ( 'id' );
		
		return $this->__pictureDir .'/'.$id;
	}
	
	
	/**
	 * @param patch to directory witch pictures.
	 */
	
	private function getPatchToMainPict( $patchTodirectory ) {
		
		return $patchTodirectory . '/'. $this->__mainName;
		
	}
	
	

	/**
	 * @param patch to directory witch pictures.
	 */
	private function getPatchToIconMainPict( $patchTodirectory ) {
		
		// Jeli cierzka do ikon jest pusta ikony znajduj się w głównym katalogu.
		 
		if ( strlen( $this->__icons ) > 0 )
		
				return $patchTodirectory . '/'. $this->$this->__icons;
				
		else  
				
				return  $patchTodirectory;
		
	}
	
	

	
}

?>