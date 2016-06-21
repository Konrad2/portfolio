<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_Models_Person
 *
 * @author Konrad
 */
class Class_Models_Person extends Zend_Db_Table {
    protected $_name = 'person';
    
    public function addPerson( $data ){
        
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->surname = $data['surname'];
        $row->exist = 1;
        
        $row->save();
        
        return $row;
        
    }
}
