<?php
session_start();
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'application/bootstrap.php';
require_once 'application/classes/GNY_Abstract.php';
require_once 'application/classes/GNY_User.php';


/**
 * GNY_User test case.
 */
/**
 * @param object $GNY_User GNY_User 
 * @author master
 */
class Auth extends PHPUnit_Framework_TestCase {
  
  /*
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
  	return is_a($this->GNY_User, 'GNY_User');
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
  
  public function testRegister()    
  {
  	/* @var $userObj GNY_User */ 
  	$this->GNY_User->name = 'test'.time();
  	$this->GNY_User->password = 'qwe123qwe';
    $userObj = $this->GNY_User->register();
    if ($userObj) {
        print 'Registered';
        return $userObj;
    } else {
        $this->fail(GNY_Error::getErrors());
    }
  }

  /**
   * @depends testRegister
   * @dataProvider testRegister
   */
  public function testAuth(GNY_User $userObj)
  {
      $data = array('name' => $userObj->name, 'password' => 'qwe123qwe' );
      unset($this->GNY_User);
      $this->GNY_User = new GNY_User();
      $this->GNY_User->authenticate($data);

      if ( $this->GNY_User->isAuthenticated()) {
          print 'Authenticated';
      } else {
          foreach (GNY_Error::getErrors() as $error )
              $this->fail("auth: ". $error);
      }
  }
  /**
   * Constructs the test case.
   */
  public function __construct() {
    // TODO Auto-generated constructor
  }

}

