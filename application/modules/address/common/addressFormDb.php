<?php

/**
 * Implemêtuje us³ugi klasy abstract_formDbClient dziêki czemu pola formularza mo¿na wykorzystaæ w karzdym formularzu.
 * Model 
 * @author Konrad
 * @package Address
 * @package Factory
 * 
 */
class addressFormDb extends abstract_formDbClient
{
	
	public function init(){
		
		
		//require_once '../library/Class/forms/alNum20Req.php';
		$street = new Class_forms_alNum20Req('street');
		$street->setLabel('ulica');
		
		$homeNr= new Class_forms_alNum20Req('house_nr');
		$homeNr->setLabel('Numer lokalu');
		
		$flat = new Class_forms_alNum20Req('flat_nr');
		$flat->setLabel('Mieszkanie');
		
		$postcode= new Class_forms_alNum20Req('postcode');
		$postcode->setLabel('Kod pocztowy');

		$city = new Class_forms_alNum20Req('city');
		$city->setLabel('Miasto');
		
		$this->addElement($street);
        $this->addElement($homeNr);
        $this->addElement($flat);
		$this->addElement($postcode);
		$this->addElement($city);
		
		$this->patchToModel = '../application/modules/address/models/address.php';
        $this->modelName = 'address';
		
        $this->foreignKey = 'id_address';
       
	}	
}
?>