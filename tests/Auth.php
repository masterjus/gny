<?php
session_start();
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'application/bootstrap.php';
require_once 'application/classes/GNY_Abstract.php';
require_once 'application/classes/GNY_User.php';


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
  
  public function testUserObj()
  {
  	return null != $this->GNY_User;
  }
  
  public function testDbConnection()
  {
  	$db =& MDB2::singleton();
  	$connection = $db->getConnection();
  	return null == $connection;
  }
  public function testDbLoadModule()
  {
  	$db =& MDB2::singleton();
  	$type = $db->loadModule('Datatype', null, true);
  	return null !== $type;
  }
  public function testDbQuote()
  {
      $db =& MDB2::singleton();
      $result = $db->quote('test', 'text');
      return '' == $result;
  }
  public function testDbEscape()
  {
      $db =& MDB2::singleton();
      $result = $db->escape('test');
      return '' == $result;
  }
  
  public function testSessionId()
  {
      return null !== session_id();
  }
  
  public function testGenerateKey()
  {
      
  } 
  
  public function testRegister()
  {
  	/* @var $userObj GNY_User */ 
  	$this->GNY_User->name = 'test'.time();
    $userObj = $this->GNY_User->register();
    if ($userObj) {
        print $userObj->id;
    } else {
        return PEAR::raiseError();
    }
  }
  
  /**
   * Constructs the test case.
   */
  public function __construct() {
    // TODO Auto-generated constructor
  }

}

