<?php
/**
 * SearchController
 * 
 * @author Konrad
 * @version 
 */


class Category_searchController extends abstract_Controllers_baseController  implements interfaces_search_searchClient {
	
	
	/**
	 * akcja add dodaje paramert
	 */
	
	public function inie(){
		
		parent::init();
	}
	
	
	/**
	 * dodaje kategorię.
	 */
	public function addAction() {
		
		
		$p = $this->_request->getAlNumParam('param');	
			
		
		if ( ! empty( $p ) ) {
		
		//	if ($$this->odel->isCorect($p))
		//	{
				$system = new Class_system();
				
				$system->clearCriterion();
				
				$system->addCriterion($p);
		//	}
		}		
		
		
			$contract = Class_system::getContract( $this->param() );
		
			//TODO  System::resetPaginator();
			
			$this->_forward( 'viewall', 'view', $contract['view'] );
		
	}
	
	
	/**
	 * usuwa wszystkie kategorie.
	 */
	public function clearAction() {
		
		
		Class_system::clearCriterion();
		
		$contract = Class_system::getContract( $this->param() );
		
		$this->_forward( 'viewall', 'view', $contract['view'] );
		
	}
	
	

}

