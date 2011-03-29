<?php

require_once 'PHPUnit/Framework/TestCase.php';
require_once '../application/classes/GNY_User.php';

/**
 * GNY_User test case.
 */
class Auth extends PHPUnit_Framework_TestCase {
  
  /**
   * @var GNY_User
   */
  private $GNY_User;
    
  /**
   * Prepares the environment before running a test.
   */
  protected function setUp() {
    parent::setUp();
    
    // TODO Auto-generated Auth::setUp()
    

    $this->GNY_User = new GNY_User(/* parameters */);
  
  }
  
  public function register()
  {
    $this->GNY_User->register();
  }
  
  /**
   * Constructs the test case.
   */
  public function __construct() {
    // TODO Auto-generated constructor
  }

}

