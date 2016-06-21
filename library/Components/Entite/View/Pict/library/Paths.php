<?php

/** 
 * @author Konrad
 * @package Pictures
 * 
 * Klasa jest zbiorem cierzek do obrazków.
 * Zawiera takie informacje cierzka do folderu z obrazkami, do folderu według konkretnego id. Nazwę obrazka głównego, cieżki do ikon.
 */
class Pict_library_Paths {
	
	/**
	 * klucz podmiotu do kturego dowizujemy obrazki.
	 * @var unknown_type
	 */
	
	private $__id;
/**
	 * @var string cieżka do katalogu ze zdięciami. 
	 */
	private $__dir;
		
	/**
	 * Scierzka od katalogu głównego do folderów z ikonami.
	 * @var string 
	 */
	protected $__icons;
		
	/**
	 * Scieżka od folderu do folreru z obrazkami. Domylnie pusta. 
	 * @var unknown_type
	 */
	private $__subPathToBigPictures;
	
	/**
	 * Nazwa obrazka wywietlanego jako główny. Domyslnie main
	 * @var string
	 */
	protected $__MainPictureName = 'main';

	/**
	 * Scieżka od indeksu do obrazków. Domyslnie images. 
	 * @var unknown_type 
	 */
	protected $__indexImages = 'images';
	
	/*
	public function __construct( $id ) {
		
		if ( is_int ( $id ) )
		
				$this->__id = $id;
				
		else
		
				throw new exception('nie przekazano id do konstruktora');
				 
	}
	*/
	
	function getPatchToDirectory( $id = null ) {
		
		
		$result = $this->__dir;
		
		if ($id !== null){
			
					$result.= '/'. $id;
		}
		
		return $result;
				
	}
	
		
	public function getPathFromIndexToImages( ) {
						  
			return $this->__indexImages;
	}
	
	
	protected function _getMainPictureName(){
		
		return $this->__MainPictureName;
	}
	
	protected function _setMainPictureName( $name ){
		
		$this->__MainPictureName = $name;
	}
	
	
	protected function _getPatchToIconDirectoryFromIndex( $id ) {
		
		
						  
			return $this->__indexImages.'/'.$id.'/'.$this->__icons;
		
	}
	
	
	private function getPathFromIndexToBigPictures( $id ){

		
		$path = $this->__indexImages.'/'.$id;
		
		if ( strlen( $this->__subPathToBigPictures ) )

					$path .= '/'.$this->__subPathToBigPictures;
					 
		
		return $path;
			
	}
	
		/**
	 * @return string Zwraca nazwę głównego obrazka.
	 */
	
	function getMainPictureName() {
		
		
		return $this->__MainPictureName;	
			
	}
	
	
	protected function getMainIconPictureName(){
		
		
		return $this->__MainPictureName;
		
	}
	
	/**
	 * Zwraca cieżkę od katalogu do katalogu z ikonami
	 */
	
	protected function getSubPathToIcons( ) {
		
		return $this->__icons;
	}

	
	public function getPatchToIconDirectory( $id ) {
		
		
		$path =  $this->getPatchToDirectory().'/'. $id;
		
		
		if ( strlen ( $p = $this->getSubPathToIcons() ) > 0 )
		
					$path .= '/'.$p;

						
		//$path .= $this->getMainPictureName();		

		
		return $path;
	}
	
	
	/**
	 * Zwraca wszystkie scierzki do plików wraz z nazwami plików. Scierzki mozna w petli wyswietlac w widoku jako obrazki. 
	 * @param unknown_type $id
	 * @return array
	 */
	
	private function getPathToBigPictureDirectory( $id ) {
		
		
		$path = $this->getPatchToDirectory( $id );
		
		$subPath = $this->__subPathToBigPictures;
		
		
		if ( strlen( $subPath ) > 0 ) {
			
					$path .= '/' . $subPath;
					
		}
		
		
		return $path;		
	}
	
	
	
	
	
	/**
	 * Zwraca obraski przypisane do danego id.
	 * 
	 * @return array 
	 * @param int $id
	 */
	
	public function getPathsToBigPicture( $id ) {
		
		
		$path = $this->getPathToBigPictureDirectory($id);
		
		$files = array();
		
		try {
				
				$files = Class_dir_dir::getFilesNames( $this->getPathFromIndexToBigPictures( $id ) );			
				
		} catch ( Exception $ex){
			
				//pictures no exist
				
		}
		
		
		$PathsToBigPict = array();
			
				
		foreach ( $files as $file ) {
			
				$PathsToBigPict[] = $path . '/' . $file;
		}
		
		return $PathsToBigPict;
		
	}
	
	/**
	 * 

/**
	 *  @return array
	 * @param $id
	 */
		 
	public function getPathToIcons( $id ) {
		
		
			$path = $this->getPatchToIconDirectory( $id );
			//$path = $this->_getPatchToIconDirectoryFromIndex( $id );
			
			$files = array();
			
			try {
					
					$files = Class_dir_dir::getFilesNames( $this->_getPatchToIconDirectoryFromIndex( $id ) );
			
			} catch( Exception $ex) {
				
					// notching. Picture not exsists.
			}
			
			
			
			$PathsToIcons = array();
			
				
			foreach ( $files as $file ) {
			
					$PathsToIcons[] = $path . '/' . $file;
			}
			
			return $PathsToIcons;
	
	} 
	
	
	
	/**
	 * -------------
	 * @param id
	 */
	function getPathToMainIcon( $id ) {
		
		
		$path =  $this->getPatchToDirectory() . '/' . $id.'/';
		
		
		if ( strlen ( $p = $this->getSubPathToIcons( $id ) ) > 0 )	{
			
		
					$path .= $p
				
						  . '/';
		}
		
						
		$path .= $this->getMainIconPictureName();		

		
		return $path;
		
	}
	
	
	/**
	 * 
	 * @param id
	 */
	 public function getPatchToMainPict( $id ) {
		
	 	
		//return $this->getPatchToDirectory().'/'.$this->__id.'/'.$this->getMainPictureName();
		return $this->getPatchToDirectory().'/'.$id.'/'.$this->getMainPictureName();
		
	}

	
	public function getConcretePatchs($id) { 
		
		
	}
	
	
	public function setPathToDirectory( $path ) {
		
		$this->__dir = $path;
	}

	/**
	 * Ustawia cieżkę do obrazków względu index.php.
	 * @param string $path
	 */
	public function setPathFromIndexToImages(  $path ){
		
		$this->__indexImages = $path;
	}
	
	
	
	
	/**
	 * Ustawia nazwę głównego obrazka.
	 * @param path
	 */
	function setMainPictureName( $path ) {
		
		$this->__MainPictureName = $path;
	}

	

	/**
	 * 
	 * @param path
	 */
	function setSubPathToIcons( $path ) {
		
		$this->__icons = $path;		
	}
	
	
	
	
	
	
	/**
	 * 
	 * @param id
	
	
	public function getPatchToIconMainPict( $id ) {
		
		
		return $this->getPathToDirectory() . '/' . $this->getPatchToIconDirectory($id) . '/' . $this->getMainIconPictureName();
		
	}
	 */
//-------------------------------------


	
	/**
	 * 
	 * @param id
	 */
	 public function getIcons($id)
	{
	}
}

?>