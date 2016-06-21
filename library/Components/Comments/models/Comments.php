<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comments_models_Comments
 *
 * @author Konrad
 */
    
class Components_Comments_models_Comments extends Zend_Db_Table {
    
    protected $_name = 'comments';
    
    public function addComent( $data){
        
        $row = $this->createRow();
        $row->name =$data['name'];
        $row->description = $data['description'];
        $row->id_entite = $data['id_entite'];
        $row->save();
        
    }
    //put your code here
}
