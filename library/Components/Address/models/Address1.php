<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adress
 *
 * @author Konrad
 */
class Components_Address_models_Address1 extends Zend_Db_Table {
    protected $_name = 'address';
    
    public function addAddress($data){
        
        $row = $this->createRow();
              
        $row->street = $data['street'];
        $row->house_nr = $data['house_nr'];
        $row->flat_nr = $data['flat_nr'];
        $row->postcode = $data['postcode'];
        $row->city = $data['city'];
        $row->exist = 1;
        $row->save();
        return $row;
        
    }

}
