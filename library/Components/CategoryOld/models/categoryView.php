<?php

/** 
 * @author Konrad
 * @package Category
 * 
 * 
 */
class categoryView extends abstract_viewModel {

	
	protected function _setupTableName() {
		
		
        $this->_name = 'category';
        
        parent::_setupTableName();
        
    }
    
    
    
     public function getSubcat( $id ) {
    	   	
    	
    	$select = $this->select();

    	$select->from($this->_name);

    	$select->where( $this->getAdapter()->quoteInto( 'id_subcategory = ?', $id ) );

    	$subCat =  $this->fetchAll( $select );
    
    	
     }
     
     
     
    /**
     * 
     * @param $id jeœli maj± byæ kategorie g³ówne wówczas przekazujemy id = 0.
     * 
     */
    
    public function getSubcategories( $id ) {
    	   	
    	
    	$select = $this->select();

    	$select->from($this->_name);

    	$select->where( $this->getAdapter()->quoteInto( 'id_subcategory = ?', $id ) );

    	$subCat =  $this->fetchAll( $select );

    	
    	if ( count( $subCat ) > 0 ) {
    		

    		echo '<ul>';
    		
    		
    		foreach( $subCat as $row ) {
    			
    			
    		//		echo '<li><a href=/new/category/search/add/param/'.$row->id.'">'.$row->name.'</a></li>';
    			echo '<li><a href="/new/things/view/search2/param/' . $row->id . '">' . $row->name . '</a></li>';
    			
    			
    			$page = new Zend_Navigation_Page_Mvc( array(
    							'action' => 'search2',
								'controller' => 'view',
								'module' => 'things',
    							'params' => array(
    											'param'=>$row->id ),	
    			) );
    			
    			 	$this->getSubcategories( $row->id );
    			 	
    		}  
    		  		
    		
    		echo '</ul>';
    		
    	}
    	
    }
    
   
    
    
}

?>