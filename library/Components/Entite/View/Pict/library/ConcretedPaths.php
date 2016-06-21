<?php
/**
 * 
 * @author Konrad
 *	@package Pictures
 */
class Pict_library_ConcretedPaths extends Pict_library_Paths  {
	
	
	private $__id;
	
	/**
	 * 
	 * @param $id int id obiektu.
	 */
	public function __construct( $id ) {
		
		
		if ( is_int ( $id ) )
		
				$this->__id = $id;
				
		else
		
				throw new exception('nie przekazano id do konstruktora');
				 
	}
	
	
	/**
	 * @return  string cieżkę do katalogu ze zdięciami konkretnego obiektu(w sęsię przedmiotu, produktu).
	 */
	public function getPatchToDirectory(  $id = null ) {
		
		
		$result = parent::getPatchToDirectory( $id );
		
		
			
		$result.= '/'. $this->__id;
		
		
		return $result;
				
	}
	
	public function getPathFromIndexToImages( ) {
		
		//echo'jest'. parent::getPathFromIndexToImages( );
		
			return parent::getPathFromIndexToImages( ) . '/' . $this->__id;
	}
	
	
	public function getPathFromIndexToMainPicture( ) {

		
		$result = $this->getPathFromIndexToImages( );
		
		$result .= '/' . $this->_getMainPictureName(); 
		
		return $result;
		
	}
	
	public function getPathFromIndexToMainIcon( $id ) {

							
		$result = $this->_getPatchToIconDirectoryFromIndex() . '/' .$this->__MainPictureName;
				
		
		return $result;
		
	}
	
	
	
	public function _getPatchToIconDirectoryFromIndex( $id ) {
		
	
		return $this->__indexImages . '/' . $this->__id . '/' . $this->__icons;
		
	}
	
	/**
	 * @return string zwraca scieżkę do katalogu z ikonami.
	 */
	public function getPatchToIconDirectory( $id ) {
		
		
		//$path =  $this->getPatchToDirectory() . '/' .  $this->__id;
		$path =  $this->getPatchToDirectory();// . '/' .  $this->__id;
		
		
		if ( strlen ( $p = $this->getSubPathToIcons() ) > 0 )
		
					$path .= '/'.$p;

						
		//$path .= $this->getMainPictureName();		

		
		return $path;
	}
	
	public function getPatchToIconDirectoryFromIndex(){
		
			$path = $this->getPathFromIndexToImages().'/'.$this->getSubPathToIcons(); 
		
			return $path;
	
		
	}
	
	/**
	 * @return array Tablice ze cierzkami do ikon(Tablicę ikon.
	 */
	public function getPathToIcons( $id ) {
		
		
			$path = $this->getPatchToIconDirectory( );
			//$path = $this->_getPatchToIconDirectoryFromIndex( $id );
			
			
			
			$files = Class_dir_dir::getFilesNames( $this->_getPatchToIconDirectoryFromIndex( $this->__id ) );
			
			
			
			$PathsToIcons = array();
			
				
			foreach ( $files as $file ){
			
					$PathsToIcons[] = $path . '/' . $file;
			}
		
			return $PathsToIcons;
	
	} 
	
	/**
	 * @return string cieżkę do głównej ikony.
	 */
	function getPathToMainIcon( $id ) {
		
		
		$path =  $this->getPatchToDirectory() . '/' . $this->__id .'/';
		
		
		if ( strlen ( $p = $this->getSubPathToIcons( $this->__id ) ) > 0 )	{
		
		
					$path .= $p
		
						  . '/';
		}
		
		
		$path .= $this->getMainIconPictureName();		

		
		return $path;
		
	}
	
	/**
	 * @return string Scieżkę do głównego obrazka.
	 */
 	public function getPatchToMainPict( $id ) {
		
	 	
		//return $this->getPatchToDirectory().'/'.$this->__id.'/'.$this->getMainPictureName();
		return $this->getPatchToDirectory() .'/'.$this->getMainPictureName();
		
	}
	
	/**
	 * @return string Scieżkę do głównego obrazka.
	 */
 	public function getPatchToMainPictFromIndex( ) {
		
	 	
		//return $this->getPatchToDirectory().'/'.$this->__id.'/'.$this->getMainPictureName();
		return $this->getPathFromIndexToImages() .'/'.$this->getMainPictureName();
		
	}
	
}

?>