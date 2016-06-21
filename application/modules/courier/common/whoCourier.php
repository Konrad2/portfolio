<?php

/**
 * Us�ugi �wiadcz�ce na rzecz modu�u sprzedarzy. Wybieranie kuriera podczas sprzedarzy. Klasa urzywa machanizmu FormDb.
 * @author Konrad
 * @package Courier
 *
 */
class whoCourier extends abstract_formDbClient {
	
	public function init (){
		/*
		require_once('../application/modules/courier/models/courier.php');
		
		$t = new courier();
		
		$table = $t->fetchAll();
		
		if ( count($table) > 0 )
		{
			$sel= new Zend_Form_Element_Select('id_courier');
			$sel->setLabel('Kurier')
			->setRequired(true);
		
			foreach($table as $r)
			{
				$sel->addMultiOption($r->id, $r->name);
			}
			$this->addElement($sel);
		}	
		*/
		$this->patchToModel = '../application/modules/courier/models/courierInsert.php';
		$this->modelName = 'courierInsert';

		$this->foreignKey = 'id_courier';
		
		//$this->addSelectFromTable('Kurier', 'name');
		$m = $this->getModel();
		$s = Class_forms_myHandling::createSelect( $m->getNames('courier_name')->toArray(),'id_courier',false);
		$s->setLabel('Kurier');
		$this->addElement($s);
		
	}	
	
	/*
	public function insert($row=null, $data=null, $values=null){
		
		require_once '../application/modules/courier/models/courierInsert.php';

		$courier = new courierInsert();
		$courier->doInsert( $row, $data);

		if( $this->child != null )
			 $this->child->insert($row, $data);
	}
	*/
}

?>
	
