<?php
require_once 'application/bootstrap.php';
require_once 'application/classes/GNY_User.php';
/**
 * GNY_User test case.
 */
class session extends PHPUnit_Framework_TestCase
{
    /**
     * @var GNY_User
     */
    private $GNY_User;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        // TODO Auto-generated session::setUp()
        $this->GNY_User = new GNY_User(/* parameters */);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated session::tearDown()
        $this->GNY_User = null;
        parent::tearDown();
    }
    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }
    /**
     * Tests GNY_User->__construct()
     */
    public function test__construct ()
    {
        // TODO Auto-generated session->test__construct()
        $this->markTestIncomplete("__construct test not implemented");
        $this->GNY_User->__construct(/* parameters */);
    }
    /**
     * Tests GNY_User->load()
     */
    public function testLoad ()
    {
        // TODO Auto-generated session->testLoad()
        $this->markTestIncomplete("load test not implemented");
        $this->GNY_User->load(/* parameters */);
    }
    /**
     * Tests GNY_User->authenticate()
     */
    public function testAuthenticate ()
    {
        // TODO Auto-generated session->testAuthenticate()
        $this->markTestIncomplete("authenticate test not implemented");
        $this->GNY_User->authenticate(/* parameters */);
    }
    /**
     * Tests GNY_User->register()
     */
    public function testRegister ()
    {
        // TODO Auto-generated session->testRegister()
        $this->markTestIncomplete("register test not implemented");
        $this->GNY_User->register(/* parameters */);
    }
    /**
     * Tests GNY_User->startUserSession()
     */
    public function testStartUserSession ()
    {
        // TODO Auto-generated session->testStartUserSession()
        $this->markTestIncomplete(
        "startUserSession test not implemented");
        $this->GNY_User->startUserSession(/* parameters */);
    }
    /**
     * Tests GNY_User->isAuthenticated()
     */
    public function testIsAuthenticated ()
    {
        // TODO Auto-generated session->testIsAuthenticated()
        $this->markTestIncomplete(
        "isAuthenticated test not implemented");
        $this->GNY_User->isAuthenticated(/* parameters */);
    }
}

