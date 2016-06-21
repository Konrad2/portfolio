<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_picture_Manager2 extends Class_picture_manager {
	
	
	private $__mainName = 'main.jpg';
	
	
	private $__PatchToPictureStore = 'images/things/';
	
	private $__PatchToIcon = '/icon/';// $__PatchToPictureStore + __PatchToIcon = Patch to icon
	
	private $__PatchToBigPictures = '';
	
	
	
/**
	 * @return __pictureDir .'/'. id .
	 */
	
	private function getPatchToImage() {
		
		
		$id = $this->_request->getIntParam ( 'id' );
		
		return $this->__pictureDir .'/'.$id;
	}
	
	
	/**
	 * @param patch to directory witch pictures.
	 */
	
	private function getPatchToMainPict(  ) {
		
		return $this->__PatchToPictureStore . '/'. $this->__mainName;
		
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
	/**
	 * 
	 * Przenosi obraz. Je�li w docelowym katalogu nie ma pliku main, zmienia nazw� na main.jpg. Tworzy ikon�. 
	 * 
	 * @param string $patch
	 * @param string $destination
	 * @param string $fileName
	 * 
	 */
	

	/** 
	 * Zwraca nazw obrazka gownego.
	 * 
	 * @param unknown_type $dir
	 *  
	 */
	
	public function getMainPath($dir) {
		
		
		return $dir.'/main.jpg';
		
	}
	
	/**
	 * 
	 * @param string $patch 
	 */
	
	private function getIconPatch( $patch ) {
		
		
		return dirName( $patch ) . '/icons/' . basename( $patch );
		//return dirName($patch).'/icons';
	}

	
	
	/**
	 * 
	 * @return Zwraca nazwy plik�w z katalogu.
	 * 
	 */		
	
	public function getIcons($dir){
		
		
		$iconsNames = array();
		
		if ( file_exists($dir) ) {
			
			
			$iconsNames = Class_dir_dir::getFilesNames($dir);					
		}
	
		
		return $iconsNames;
		
	}

	
	
	/**
	 * 
	 * Tworzy Ikone.
	 * 
	 * @param unknown_type $patch
	 * @param unknown_type $destination
	 */
	
	private function createIcon( $patch, $destination, $iconName )	{

		
		try {
		
			
			if ( file_exists( $patch ) ) {

				
				if ( ! is_dir( $destination ) )
				
				
					if ( ! mkdir( $destination ) )
					
					
						throw new Exception("nie mo�na utworzy� katalogu dla ikony");			
				

						
				$icon = $this->resize($patch, 200);
				
				imagejpeg($icon,  $destination.'/'.$iconName);
				
				
			}

			
		} catch (Exception $ex ) {
			
			
				$this->errors = $ex->getMessage();
			
			
				return false;		
			
		}
		
		
		return true;
		
		
	}
	
	

}

?>