<?php

abstract class abstract_Controllers_ViewsearchsystController extends abstract_Controllers_viewController //implements interfaces_search_searchController
{
	
	/**
	 * 
	 * @var unknown_type
	 */
	protected $_searcher;
	
	
	public function init() {
		
		
		parent::init();

		$this->_searcher = new abstract_Search_ManyCriterions($this->_request->getModuleName());
		
	}
	
	
	
	public function searchAction() {
		
		echo "search controller search actioon now (sow dont delete";
		
		$param = $this->_request->getParam('value');
		
		$search = new Class_searcher( $this->_request->getModuleName() );
		
		$search->addParam($param);

		$this->_forward('viewall');
	}
	
	
	public function viewallAction()
	{
		$this->renderMenu();
		
		$this->viewMessage();
		
		$this->view->controler = $this->_request->getControllerName();
		$this->view->action = 'viewone';

		//1.0
	//	$searcher = new Class_searcher();
	//	$sel = $searcher->select();

		//1.1
	//	$tab =  Class_system::getCriterion();
		//$model = $this->getModel();
		
		/**
		 * @version 1.0
		 */
		//$this->view->paginator = new Class_paginatorView($this->model->getSelect($sel), $this->_request->getModuleName());
		/**
		 * @version 1.1
		 */
		
		//$this->view->paginator = new Class_paginatorView($this->model->getSelect($tab), $this->_request->getModuleName());
		
		/**
		 * @version 1.2
		 */
		$sel = $this->_searcher->select();
	//	echo '<br/>'. $sel;
		$this->view->paginator = new Class_paginatorView($this->model->getSelect( $sel ), $this->_request->getModuleName());
		
		
		//$this->view->paginator = new Class_paginatorView($sel, $this->_request->getModuleName());
	}
	/*
	public function addcriterionAction(){
		
		$this->addCriterion($this->_request);		
	}
	*/
	public function search2Action(){
		
		try{
			$this->addCriterion($this->_request);		
		}
		catch(Exception $ex){
			
			echo $ex->getMessage();
			/**
			 * @todo handle exception
			 */
		}
		$this->_forward('viewall');
	}
	
	protected function addCriterion($request){		
	 
		$p = $request->getAlNumParam('param');		
		
		if ( !empty($p)){
		
			if ($this->isCorect($p))
			{				
				$system = new Class_system();
				$system->clearCriterion();
				
				/**
				 * @todo clear paginator
				 */
		
				$system->addCriterion($p);							
			}
			else 
				throw new Exception('Nie poprawne kryterium wyszukiwania');
		}		
		
		
			//$contract = Class_system::getContract( $this->param() );
		
			//TODO  System::resetPaginator();
			
		//	$this->_forward( 'viewall', 'view', $contract['view']);
	}
	
	protected function isCorect($param){
		
		return true;
	}
}

?>