<?php

/** 
 * @author Konrad
 * @package model
 * 
 */
class Class_model  {
	
	static public function getColandId($model, $colName)
	{
	
		$select = $model->select();

		$select->from( $model->getName() );
		
		
		$select->columns( $colName );
		
		$result =  $model->fetchAll( $select );
		
		return $result;		
	}

}
