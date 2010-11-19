<?php
require_once 'JSON.php';

final class GNY extends Services_JSON
{
  private $_action;
  private $_request;
  private $_response;
  private $_json;
  private $_user;
  private $_db;
  
  public function __construct()
  {
    
    $this->_db =& MDB2::singleton();
  }
  
  public function process(array $post)
  {
    $this->_request = $post;
  }
  
  public function response()
  {
    if (GNY_Error::hasErrors())
      $this->_response = GNY_Error::getErrors();
    return $this->_response;
  }
  
  public function parseRequest()
  {
    if ( !isset($this->_request['action']) ) {
      GNY_Error::addError('Action wasn\'t found');
    }
  }
  
  private function _generateKey()
  {
    global $config;
    $keyLine = $config['secret']['key']. time();
    if (null !== $this->_user){
      $keyLine .= $this->_user->id;
    }
    $key = sha1($keyLine);
    //TODO Сохранить ключ в базу
    /*$query = $this->_db->escape('INSERT INTO _');
    $this->_db->query();
    */
    return $key;
  }
  
  private function _validateKey()
  {
    
  }
}

class GNY_Error 
{
  private static $_errors;
  
  public static function addError($message)
  {
    self::$_errors[] = $message;
  }
  
  public static function hasErrors()
  {
    return !empty(self::$_errors);
  }
  
  public static function getErrors()
  {
    return self::$_errors;
  }
}