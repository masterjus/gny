<?php


final class GNY extends GNY_Abstract
{
  private $_action;
  private $_request;
  private $_response;
  private $_user;
  
  public function __construct()
  {
    
  }
  
  public function process(array $post)
  {
    $this->_request = $post;
    $this->_parseRequest();
  }
  
  public function response()
  {
    
    
    
    
    
    if (empty($this->_response)) {
      GNY_Error::addError('Empty response');
    }
    
    if (GNY_Error::hasErrors()) {
      $this->_response = $this->_makeJson('error',null,GNY_Error::getErrors());
    }
    return $this->_response;
  }
  
  private function _makeJson($action, $userId, $message) {
    $message = serialize($message);
    $response = array(
      'action' => $action,
      'userId' => $userId,
      'message' => $message,
    );
    
    return $this->encode($response);
  }
  
  private function _parseRequest()
  {
    if ( !isset($this->_request['action']) ) {
      GNY_Error::addError('Action wasn\'t found');
      return;
    }
    $this->_action = $this->_request['action'];
    $this->_user = new GNY_User($this->_request['userId']);
    
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