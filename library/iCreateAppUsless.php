<?php
interface iCreateApp
{
	public function initAuth();	
	public function initModulesReg();	
	public function initDB();
	public function initModule();
	public function start();
}
?>