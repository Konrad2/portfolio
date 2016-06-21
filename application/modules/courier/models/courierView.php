<?php

/** 
 * @author Konrad
 * @package Courier
 *
 */
class courierView extends abstract_viewModel
{
	public function init(){
		
		parent::init();
		$this->_moduleName = 'courier';
		$this->foreignKey = 'id_courier';
	}

	protected function _setupTableName()
    {
        $this->_name = 'courier';
        parent::_setupTableName();
    }

	private function createTable()
	{
		/*	"CREATE TABLE  `courier` (
	 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	 `name` VARCHAR( 64 ) NOT NULL ,
	 `prise` INT NULL ,
	 `priorPrise` INT NULL ,
	 `id_adres` INT NULL ,
	 `id_contact` INT NULL
	) ENGINE = MYISAM ;";
	*/
	}
	
	protected function getCol(){
		
		return array('id'=>'id','Nazwa'=>'courier_name','Cena przesylki'=>'package_price');
	}
	
	protected function customCol(){
		
		return array('id'=>'id', 'Nazwa kuriera'=>'courier_name','Cena przesylki'=>'package_price'  );
	}
	
	protected function getColsRow()
	{
		return array('id'=>'id','Nazwa'=>'courier_name','Cena przesylki'=>'package_price', 'id_address','id_person');
	}

}
?>