<?php
class Class_forms_factoryClient extends Zend_Form implements ifactory
{
	private $child;

	public function add($child)
	{
		if ($this->child == null)
			$this->child = $child;
		else 
			$this->child->add($child);
	}
	
	public function get()
	{
		if(isset($this->child))
		{
			$form = $this->child->get();
			
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