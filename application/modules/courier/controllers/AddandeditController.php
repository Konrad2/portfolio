<?php

/**
 * 
 * @author Konrad
 * @package Courier
 *
 */
class Courier_addandeditController extends abstract_Controllers_addandeditController
{
 	public function init(){
 		
 		parent::init();
 		$this->formDbName = 'courierFormDb';
 		$this->patchToFormDb = '../application/modules/courier/library/courierFormDb.php';
 	}
}
