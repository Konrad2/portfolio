<?php

class viewEntiteTest extends Zend_Test_PHPUnit_ControllerTestCase
{
     public function testArray()
    {
        
      $this->assertNull(NULL );
    }
    /*
    public function setUp()
    {
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }
    
    
    
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


