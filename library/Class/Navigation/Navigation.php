<?php
/**
 * Klasa slurzy do robienia menu kompatabilnego z KOntrolerem abstract_searchController.
 *  
 * @author Konrad
 *
 */
class Class_Navigation_Navigation extends Zend_Navigation_Page_Mvc {
	

	/**
	 * 
	 * @param string $cpatch Scierzka do pliku.
	 * @param string $section Nazwa galezi.
	 * @return assert-out Zend_Navigation.
 	 */
	public 	static function createFromFile( $patch, $section ) {
		
		
			$con =  new Class_Config_SaveConfig( $patch , $section );
			
			$container = null;
			
			if  ( ! empty ( $con ) ) {
			
				
				$container = new Zend_Navigation( $con->toArray() );		
				
			} else {				
				
				$container = new Zend_Navigation();
				
			}
			
			return $container;
			
	}
	
	/*
	public function putAcl( $menu ) {
		
			
	}
	*/
	
	public function createPage( $param ) {
		
	/*
				$page = new Zend_Navigation_Page_Mvc( array(
    							'action' => $this->__actionName,
								'controller' => $this->__controllerName,
								'module' => $this->__moduleName,
								'label' => $param->name,
    							'params' => array(
    												$this->__paramName => $param 
    											)	
    			) );
    			
    	*/

		$this->setLabel( $param->name );
		
		$this->setParams( array( $this->__paramName => $param )	);

    	//return $page;	
    			
	}	
	
	
	
	private function createPages( $array ) {
		
				
			foreach( $array as $row ) {
	    			
	    	
	    			$page =	$this->createPage( $row->id );
	    		    		
	    			$page->addPage( $this->createPage( $row->id ) );
	    			 	
	    	}
			
	}
	

	
	static public function factory ( $options ) {
		
		
		$options = Class_Navigation_Navigation::makeSreThatArrayOrError( $options );
              		
 //      	$instance = new Zend_Navigation ($options);
       	$instance = new Class_Navigation_Navigation ();
       	
        
        $instance->set( $options );
        
        
        
       /*
		 if ( isset ( $options['module'] ) ) {
		 		
		 		$this->__moduleName = $options['module'];
		 		
		 		unlink( $options['module'] );
		 		
		 }
		 		
	          
		 if ( isset ( $options['controller'] ) )
		 		
		 		$this->__controllerName = $options['controller'];
		 		
		 		
		 if ( isset ( $options['action'] ) )
		 		
		 		$this->__actionName = $options['action'];
		 		
		 		
		 if ( isset ( $options['param'] ) ) {
		 	
		 		$this->__paramName = $options['param'];
		 
		 }
		 */	
        
        return $instance;
        
	}
	
	
	
	static protected function makeSreThatArrayOrError( $options ) {
		
		
	 	if ( $options instanceof Zend_Config ) {		
		
            	$options = $options->toArray();          
            	  
       }
       
       
        if ( ! is_array( $options ) ) {
        	
        	
            	require_once 'Zend/Navigation/Exception.php';
            
            	throw new Zend_Navigation_Exception(
                	'Niepoprawny argument: $options musi by instancj klasy array lub Zend_Config');  
            
        }
		
        
        return $options;
        
	}
   

	
	
		function __set($nazwa,$wartosc) {
			
		
			$this->$nazwa = $wartosc.'set ';
		
		}
		
		
		
		public function set( $array ) {
			
			
			if ( is_array( $array  ) ) {
			
			
				  	foreach ( $array as $key => $value ) {        	
		        	
		        	
		        		$this->__set( '__'.$key.'Name', $value );
		        
		        	}        
        
			}			
			
		}
	
}

?>