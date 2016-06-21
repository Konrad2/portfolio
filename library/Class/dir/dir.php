<?php

/** 
 * @author Konrad
 * 
 * 
 */
class Class_dir_dir {
	

	static public function getFilesNames($path){
		
		$result = array();
		
		if (is_dir( $path) ){
		
				$dir = opendir($path);
				 
				if (  $dir ) {		
		
					
						while( false !== ( $file_name = readdir ( $dir ) ) ) {
							
							
								    if ( ( $file_name != "." ) && ( $file_name != ".." ) ) {
						
								    	
								    		//if ( is_file ( $path . '/' . $file_name ) )  
								     			
								    				$result[] = $file_name;		    
								    }
								    
						    
						}
						
						closedir ( $dir );
						
		
				} else {
					
						throw new Exception ( 'Class_dir_dir: katalog '. $path .' nie został otwarty' );
				}
		}
		
		
		return $result;
		
	}
	
	
	public function str_suffix($str, $n=1, $char=" ") {
		
		
    		for ( $x = 0; $x < $n; $x++) {
    			
    				$str = $str . $char; 
    		}

    		
   		 	return $str; 
	}
	
	
	public function str_prefix( $str, $n=1, $char=" ") {
		
		
  	  for ( $x = 0; $x < $n; $x++ ) {
  	  	
  	  			$str = $char . $str;
  	  }
  	   
  	  return $str;
  	   
	}
	
	
	
	static public function deleteDirectory( $path ) {

	
			   if ( is_dir ( $path ) )
			   
			   	   $dir_handle = opendir($path);
			   	   
			   else { throw new exception('nie ma takiego katalogu ' . $path );}
			   	   
			   if ( ! $dir_handle )
			   
			   		   return false;
			   		   
			   while( $file = readdir ( $dir_handle ) ) {

			   	if (	$file != "." && $file != ".."	) {
			   			
			         if ( ! is_dir( $path . "/" . $file ) )
			         
			         	   unlink($path."/".$file);
			         else
			         
			         	   Class_dir_dir::deleteDirectory ( $path.'/'.$file);     
			      }
			   }
			   
			   closedir($dir_handle);
			   
			   rmdir($path);
			   
			   return true;
			   
	}
	
	    	/*if ( $handle = opendir( $path ) ) {

	    		
	      		while ( false !== ( $file = readdir( $handle ) ) ) {
	      			 
	        			if ($file<>"." AND $file<>"..") { 
	          					
	        				
	        					if ( is_file ( $path . '/' . $file ) ) { 
	            						
	        							@unlink($path.'/'.$file); 
	          					}

	          					
					          if ( is_dir ( $path . '/' . $file ) ) {
					          	 
					            		deletefolder($path.'/'.$file);
					            		 
					            		@rmdir($path.'/'.$file); 
					          } 
	          
	        			} 
	        
	      		} 
	      
    	} else {
    		
    		 throw new exception ('folder "' . $path . '" nie zosta otwarty' );
    		 
    	}
    	*/
  	} 



?>