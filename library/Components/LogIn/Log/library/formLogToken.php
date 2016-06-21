<?php



class LogIn_Log_library_formLogToken extends LogIn_Log_library_formLog {


	public function init(){


		parent::init();


		$token = new Zend_Form_Element_Hash('token');

		$token->setSalt(md5(uniqid(rand(), TRUE)));


		$token->setTimeout( Zend_Registry::get('timout') );

		$this->addElement($token);


	}
}

?>