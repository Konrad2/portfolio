<?php
/**
 * 
 * @author Konrad
 * @package View
 * @package Entite
 */

class ViewEntites_library_PaginatorView extends  Zend_Paginator {
	
	protected $moduleName;
	
	/**�
	 * @param Zend_Db_select $select.
	 * @param string $what Nazwa modu�u.
	 */
//	public function PaginatorView($select,$what)

	/**
	 * Prawie jak konstruktor.
	 * @param unknown_type $select
	 * @param unknown_type $what
	 */
	public function initialize($what) {
		
		
		$this->moduleName = $what;
		
		//$adapter = new Zend_Paginator_Adapter_DbSelect($select);	

		//parent::__construct($adapter);

		$ns = new Zend_Session_Namespace('paginator'.$what);
		
		$this->setCurrentPageNumber ($ns->offset);

		$ns = new Zend_Session_Namespace('reg');

		$p = null;

		/*
		if (isset($ns->ItemCountPerPage))
		{
			$p = $ns->setItemCountPerPage;
		}
		else
		{
			$r = new Class_myRegistry();
			$p = $r->get('itemsCount');
		}
		*/
		
		$this->setItemCountPerPage(9);//$p;

		
		if ( isset ( $ns->setPageRange ) ) {
		
			
			$p = $ns->PageRange;
			
			
		} else {
			
			
			$r = new Class_myRegistry();
			
			$p = $r->get('pageRank');
		}
		
		
		$this->setPageRange($p);
		
	}
	
	/**
	 * @return string nazwe modu�u;
	 */
	public function getModuleName(){
		
		return $this->moduleName;
	}
}
?>