<?php

/** 
 * @author Konrad
 * 
 * @package Error
 */
class Class_Plugin_error  extends Zend_Controller_Plugin_Abstract {
	


    public function preDispatch(Zend_Controller_Request_Abstract $request) {

    	
        $this->getResponse()

             ->appendBody("<p>preDispatch() called</p>\n");

    }

 

}

?>