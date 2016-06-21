<?php
/**
 * 
 * @author Konrad
 *
 */
interface ibasket
{
	public function add($id);
	
	public function getValues();
	
	public function isValid();
}
?>