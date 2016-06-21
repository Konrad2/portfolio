<?php
/**
 * Wyb�r formy p�atno�ci przy sk�adaniu zam�wienia.
 * @author Konrad
 * @package Pay
 */
class choosePayingType extends abstract_formDbClient{
	
	public function init(){		
		
		$this->patchToModel = '../application/modules/pay/models/payTypeChoose.php';
		$this->modelName = 'payTypeChoose';
	
		$this->foreignKey = 'id_paying';
		
//		$this->addSelectFromTable('Forma P�atno�ci', 'id_type');
		$this->addSelectFromTable('Forma Płatności', 'pay_type','id_paying',false);
                $payType = $this->getElement('id_paying');
                $payType->setValue(1);
               
	}
	
	protected function _setupTableName()
    {
        $this->_name = 'pay';
        parent::_setupTableName();
    }
}

?>