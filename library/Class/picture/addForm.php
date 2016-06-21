<?php

/** 
 * @author Konrad
 * @package Pictures
 * 
 */
class Class_picture_addForm extends Zend_Form {
	
	protected $error = null;
	
	protected $_elemFileName = 'uploadFile';
	
	protected $_filePicture = null;	
	
	
	/**
	 * 
	 */
	public function init(){		
		
		/**
		 * 
		 * @var nazwa elementu typu Zend_Form_Element_Upload. Domylnie 'uploadFile'.
		 * @todo zmienic na dynamicznie.
		 * 
		 */
		
		
		
		$this->addElement('file', $this->_elemFileName, array(

           						'destination' => '../uploads',
		
            					'validators' => array(

               							array('count', false, 1),

               							array('size', false, 402400),
               							
               							array ('Extension', false , array( 'jpeg', 'jpg' , 'JPG', 'JPEG') ),
               							
               							//array ('MimeType', false , array( 'image/jpeg', 'image/jpe') )
           		 ),

           		 'label' => 'Wybierz obraz',
           		 
        ));        
        
        $this->addElement('hidden','id');
        
        $this->addElement('submit', 'submit', array(

           				 'label' => 'Wyslij'
        		));
       
        
        $this->setEnctype('multipart/form-data');	
        
	}
	
	
	/**
	 * Odbiera plik oraz zapisuje we wskazanym miejscu.
	 * @param string $dir  Miejsce zapisu pliku. 
	 */
	
	public function uploadFile ( $dir , $pictureManager) {	
		
		
		if ( $this->receive() ) {			
			
			
				$picManager = new Class_picture_manager();				
		
				$error = $picManager->add ( $this->uploadFile->getFileName() , $dir, 'main.jpg', $limitSize );
				//$error = $pictureManager->add ( $this->uploadFile->getFileName() , $dir, 'main.jpg', $limitSize );
			
			
				if ( $error != null ) {
						
						echo 'Obrazek nie zosta� zapisany z powodu "' . $error . '"</br>';
					
				} else 
						echo "Powinien zostać zapisany";
					
		}
		else {
			//Nie zosta przesany
			//throw new Exception("Obraz nie został przesłany na serwer");
		}
	
		return  $this->uploadFile->getFileName();
	}
	
	
	/*
	
	public function uploadFiles(){
		
	}
	
	*/
	
	
	/**
	 * Odbi�r pliku.
	 */
	
	protected function receive(){
		
		
		if ( ! $this->uploadFile->isUploaded() ){ 			
			
			
			// Czy cokolwiek zosta�o wys�ane?		
		     $this->error = 'Nie wybrano pliku do wysłania.';		     
		     
		     return false;
		     
		     
		}elseif ( ! $this->uploadFile->receive() ){				
			
			
			// Odbi�r pliku		
		      $this->error = 'Bład podczas odbierania pliku.';
		      return false;
		      
		       	
		 }else{		 			 
		 	
		 	
		 	// Sukces
		      return true;
		      
		     	
		 }
	}
	
	/**
	 * 
	 */
	public function getError(){
				
		
		return $$this->error;
		
	}
}

?>