<?php
class class_formDb
{
 	private $formWrapper;
 	private $model;
 	
	
 	
 	public function __construct()
 	{
 		$this->doForm();
 	}
 	
 	public function getForm()
 	{
 		
 	}
 	
 	public function isValid()
 	{
 		
 	}
 	
 	public function saveModel()
 	{
 		$c = connector('model',$sale,'sale','connections',array('orderStep1'));

 	}
 	
 	private function doForm()
 	{
 		require_once('../application/modules/sale/library/forms/dataFromClient.php');
		$mainForm = new dataFromClient();
		
		$form = null;
	
		$form = Class_factory::buildForm($mainForm,'sale','connections',array('orderStep1'));

		if($form != null)		
	   		$form->setAction( $this->getRequest()->getBaseUrl().'/sale/transaction/step1')
	       		 ->setMethod('post');
	       		 
		
		return $form->get();
 	}
 	
 	
 	
	private function doModel()
	{
		//$a = Zend_Db_Table::getDefaultAdapter();
		
		require_once('../application/modules/sale/models/sale.php');
		$sale = new sale();
		
		return Class_factory::build('model',$sale,'sale','connections',array('orderStep1'));
	}
}

?>
