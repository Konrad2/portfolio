<?php

class Components_System_library_Exceptions_noServiceFound extends Exception  {
	
	
	public function __construct (  $message  ,  $code  , $previous  ) {
		
		
			parent::__construct (  $message . ' Nie odnaleziono servisu' , $code = 0 , $previous );
			
	}

}

?>