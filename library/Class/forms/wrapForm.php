<?php
class wrapForm extends Zend_Form implements ifactory
{
	private $form;
	/*
	public function __construct()
	{
		echo"wrap constructor now<br/>";
		parent::__construct();		
	}	
	*/
	public function init()
	{
		echo "wrapper init now<br/>";
	//	parent::__construct();
	}
	/*
	public function addForm($form)
	{
		$this->form = $form;
		$array = $form->getElements();

		foreach ($array as $elem)
			$this->form->addElement($elem);

		return $form;
	}
*/
	public function add($form)
	{
		$this->form = $form;
	}
	
	public function get()
	{
		if(isset($this->form))
		{
			$form = $this->form->get();
			
			//$array = $form->getElements();
			$fo = $this->getElements();
			
			foreach ($fo as $elem)
				$form->addElement($elem);
				//or
			//$t = array_merge_recursive($fo	//$this->
				
			return $form;
		}
		else
			return $this;
	}
}
?>