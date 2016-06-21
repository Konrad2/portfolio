<?php
/**
 * 
 * Aby zdefiniować zachowanie w przypadku nieznalezienia kryterium urzyj metody setConditionIfNoCriterionFound.
 * @author Konrad
 *
 */
class Components_Entite_View_Search_models_View extends ViewEntites_models_viewModel {
	
	/** 
	 * Parametr dla systemu.
	 * @var Zend_Navigation_Page_Mvc
	 */
	private $__naviogation;
	
	private $__conditionIfNoCriterionFound = '1=1';
	
	 public function __construct($config = array(), $definition = null){
	   	
	 	
	   	parent::__construct($config, $definition);
	   	
	   	$this->__navigation = new Zend_Navigation_Page_Mvc();
	   	
	 }
	 
	 
	public function setNavigation( Zend_Navigation_Page_Mvc $navigation ) {
				
			$this->__navigation = $navigation;
			
	}
        
        public function getNavigation(){
            return $this->__navigation;
        }
	
	
	public function getSelect(  $select = null ) {
		
		
		$select = parent::getSelect( $select );
		
	
		$search = Components_System_library_System::service( 'iSearch' );		
		
		$criterions = $search->get( $this->__navigation );
		
		//$select->from ('comments');
		
		if ( count ( $criterions ) ) {		
			
				foreach ( $criterions as $key => $param ) {
			
			
						$select->where( $this->getAdapter()->quoteinto( $key.'= ?', $param ) );			
				}
				
		} else 
		
				$this->_ifNoCriterionFound( $select );		
	
		return $select;
		
	}
	
	
	/**
	 * Za pomocą metody morzemy zdefiniować warunek wyszukiwania jeli żadne kryterium nie zostanie zdefiniowane.
	 * @example
	 *  $condition == '1=1' wszyskie rekordy zostaną zwrócone. $condition == '1=0' nic nie zostanie zwrócone.
	 * @param unknown_type $condition
	 */
	public function setConditionIfNoCriterionFound( $condition ){
		
		$this->__conditionIfNoCriterionFound = $this->getAdapter()->quote($condition);
	}
	
	public function _ifNoCriterionFound( Zend_Db_Table_Select $select ){
		
		//jeli nic nie spełnia kryterium nic nie wywietlaj.  
		$select->where( $this->__conditionIfNoCriterionFound );
	}

}

?>