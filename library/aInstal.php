<?php
abstract class aInstal
{
	public $name;	
	public function instal();
	public function deinstal();
	public function addToConfig();
	public function rmFromConfig();
	public function initMod();
	public function destroyMod();
	public function saveChangeToConfig();
	private function xmlAdd($name ,$param);
}

?>