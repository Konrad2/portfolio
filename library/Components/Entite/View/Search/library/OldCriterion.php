<?php

/** 
 * 
 * Zapewnia interfejs słurzący do manipulowania kryteriami wyszukiwania w interfejsie iView. 
 * @author Konrad
 * 
 * @package Search
 */
class Components_Entite_Search_library_Criterion {	
	
	
	/**
	 * wyrarzenie podstawiane bezporednio do wyraezenia sql where np.: where id_client = 43. W tym wypadku $param = 'id_client = 43'  
	 * @param string $param 
	 * 
	 * Dane akcji w krórej dotyczy kryterium.
	 * @param Zend_Navigation $naviagation
	 */
	public function add( $param ,Zend_Navigation_Page_Mvc $naviagation) {
		
		
			$p = $this->_request->getAlNumParam('param');	
				
			
			//if ( ! empty( $p ) ) {
			
			//	if ($$this->odel->isCorect($p))
			//	{
					$system = new Class_system();
					
					$system->clearCriterion();
					
					$system->addCriterion($p);
			//	}
		//	}		
											
			

		
	}

}

?>