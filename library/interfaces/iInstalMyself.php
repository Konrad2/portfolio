<?php
interface iInstalMyself
{	
	public function instal();
	public function deinstal();
	public function addToConfig();
	public function rmFromConfig();
	public function addToReg();
	public function rmFromReg();	
	public function initMod();
//	public function destroyMod();
//	public function saveChangeToConfig();
}
?>