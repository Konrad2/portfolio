<?php


class UserControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
     public function testArray()
    {
        
      $this->assertNull(null);
    }
    
    public function setUp()
    {
        
       
        $this->bootstrap =  new Zend_Application(
    APPLICATION_ENV,
    array(
        'resources' => array(
					            'Class_Resource_initAppli' => array(),
					    		'Class_Resource_layout' =>array(),
					    		'Class_Resource_db'=> array(),
    							'modules'=>array(),
    							
					    		//'Class_Resource_frontControllerx'=>array()
   							 ),
   		'bootstrap'=>'../library/Class/Bootstrap.php'
   
	)
	);
        
        parent::setUp();
    }
    
    public function testCallMainPageAction()
    {
        $this->dispatch('/');
        $this->assertController('Cms');
        $this->assertAction('viewone');
    }
    
    
    /*
    
      public function appBootstrap()
    {
        $this->frontController
             ->registerPlugin(new Bugapp_Plugin_Initialize('development'));
    }
    
     public function testCallWithoutActionShouldPullFromIndexAction()
    {
        $this->dispatch('/user');
        $this->assertController('user');
        $this->assertAction('index');
    }
 
    public function testIndexActionShouldContainLoginForm()
    {
        $this->dispatch('/user');
        $this->assertAction('index');
        $this->assertQueryCount('form#loginForm', 1);
    }
 
    */
}


