<?php
/**
 * @package Search
 * @author Konrad
 *
 */
abstract class abstract_Controllers_viewsearchController extends abstract_Controllers_viewController //implements interfaces_search_searchController
{
	
	/**
	 * 
	 * @var abstract_Search_Searcher
	 */
	protected $_searcher;
	
	
	
	public function init() {
		
		parent::init();

		
		$this->_searcher = new abstract_Search_ManyCriterions($this->_request->getModuleName());

	}
	
	/*
	
	public function searchAction() {
		
		
		echo "search controller search actioon now (sow dont delete";
		
		$param = $this->_request->getParam('value');
		
		$search = new Class_searcher( $this->_request->getModuleName() );
		
		$search->addParam($param);

		$this->_forward('viewall');
		
	}
	
	*/
	
	public function viewallAction()	{
		
		
	//	$this->renderMenu('../application/modules/'.$this->_request->getModuleName().'/config.xml', 'menu');
		
		$this->viewMessage();
		
		$this->view->controler = $this->_request->getControllerName();
		
		$this->view->action = 'viewone';


		$sel = $this->geCryteriomSearching();

		
		$this->view->paginator = new Class_paginatorView( $this->model->getSelect( $sel ), $this->_request->getModuleName() );		
		
	}
	
	
	/**
	 * Zwraca obiekt zawierający wryteria do wyciągania z bazy sql.
	 */
	public function geCryteriomSearching(){
		
		
		return $this->_searcher->select();
		
	}
	
	public function search2Action() {

		
		try {
			
			$this->addCriterion($this->_request);
					
		}
		
		catch ( Exception $ex ) {
			
			
			echo 'abstract searcheer controller: 73 '.$ex->getMessage();

		}
		
		
		$this->_forward( 'viewall' );
		
	}
	
	
	
	private function addCriterion( $request ) {	
		
	
		$p = $request->getAlNumParam( 'param' );
		
		
		if ( ! empty ( $p ) ) {
			
			//TODO - if ($this->isCorect)
			
				$this->_searcher->addParam( $p );
				
			
		} else {
			
				throw new Exception( "nieprawidowy parametr view search controller (addcriterion)" );	
				
		}

		
	}
	
	
	
	public function clearAction() {
		
				
		$this->_searcher->clear();
		
		$this->_forward( 'viewall' );
		
	}
	
	
	abstract protected function isCorect ( $param );// {		
		
	//	return true;
		
	//}
	
	
}

?>