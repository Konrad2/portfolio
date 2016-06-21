<?php
/**
 * 
 * @author Konrad
 * @package Sale
 *
 */
class Sale_ViewController extends abstract_Controllers_viewController
{		
	protected $_navigationParentForIRelated;
	
	
		public function init()
		{
			parent::init();

			$system = new Class_system();

			$patch = $system->patchToModule();

			$patch .= '/sale/views/scripts';
			$this->view->setScriptPath($patch);
			
			$this->_navigationParentForIRelated= new Zend_Navigation_Page_Mvc(array('module'=>'Sale','controller'=>'View', 'action'=>'viewone') );
		}

		/**
		 * Wy�wietla dane o zamuwieniu poniewarz wiewone wy�wietla tylko produktyt. 
		 * Po��czone z viewone za pomoc� helpera action.
		 */
		
	public function viewoneAction() {		
		
		$id = $this->_request->getIntParam('id');
		
		$parentRow = $this->model->getOne($id);
		
		Components_System_library_System::service('iRelated')->setRelatedParent( $this->_navigationParentForIRelated , $parentRow);
				
		require_once '../application/modules/sale/models/saleView.php';
		$m = new saleView();
		
		echo 'Suma zamówienia = '. $m->sumOrder($id).'</br>';
		
		parent::viewoneAction();
	}
		
		public function one2Action()
		{
			$id = $this->_request->getIntParam('id');
			$r = $this->model->getOne2($id);

			$this->view->order = $r;
		}
                
                public function viewallAction() {
		
		
		$this->view->whatShow = $this->_whatShow_all;
		
		 $this->renderMenu ();
		
		$this->view->controler = $this->_request->getControllerName ();
		
		$this->view->action = 'viewone';
                
              //  $select = $this->model->getSelect ();
               // $select->order('data zamówienia asc');
               
                //echo $select->__toString();
		$this->view->paginator = new Class_paginatorView ($this->model->getSelect (), $this->_request->getModuleName () );
	}
}
