<?php
error_reporting('E_ALL');
require_once 'classes/GNY_Abstract.php';
require_once 'classes/GNY_User.php';

final class GNY extends GNY_Abstract
{
  private $_action;
  private $_request;
  private $_response;
  private $_user;
  protected $_json;
  public $debug = false;
  
  public function __construct()
  {
    parent::__construct();
    $this->_json = new Services_JSON();
    
  }
  
  public function process(array $post)
  {
    parent::__construct();
    $this->_request = $post;
    $this->_parseRequest();
    
    $userId = isset($this->_request['uid']) ? $this->_request['uid'] : null;
    $this->_user = new GNY_User($userId);
    
    $this->_response = null;

    switch ($this->_action) {
      case 'reg':
          if ( $this->_user->register($this->_request) ) {
              $this->_response['status'] = 'OK';
          }
        break;
      case 'auth':
          if ( $this->_user->authenticate($this->_request) ) {
              $this->_response['status'] = 'OK';
              $this->_response['uid'] = $this->_user->id;
              $this->_user->startUserSession();
          }
        break;
      default:
        if ( $this->_validateKey() ) {  
            $this->_user->startUserSession();
            $this->_response['uid'] = $this->_user->id;
            switch ($this->_action) {
                case 'online_list':
                 $this->_response['list'] = $this->_user->getOnlineUsersList();;
                break;
            }
        } else {
            GNY_Error::addError("The key isn't valid!");
        }
        break;
      }
    
  }
  
  public function getResponse()
  {
        
    if (GNY_Error::hasErrors()) {
      $this->_response = array('status' => 'error', 'message' => GNY_Error::getErrors());
    }
    if (empty($this->_response)) {
      GNY_Error::addError('Empty response');
      $this->_response = array('status' => 'error', 'message' => GNY_Error::getErrors());
    }
    if ($this->_user->isAuthenticated()) {
        $this->_response['key'] = $this->_user->key;
    }
    return $this->_makeJson($this->_action, $this->_user->id, $this->_response );
  }
  
  private function _makeJson($action, $userId, $message) {
    $message = serialize($message);
    $response = array(
      'action' => $action,
      'userId' => $userId,
      'result' => $message,
    );
    
    if ($this->debug)
      return $this->_json->encodeUnsafe($response);
    else 
      return $this->_json->encode($response);
  }
  
  private function _parseRequest()
  {
    if ( !isset($this->_request['action']) ) {
      GNY_Error::addError('Action wasn\'t found');
      return;
    }
    $this->_action = $this->_request['action'];

  }
  
  private function _do()
  {

  }
  
  public function load()
  {
      return $this;
  }
  
  private function _validateKey()
  {
    if ($this->_user->isAuthenticated() && !empty($this->_request['key']) ) {
      $sSql = "SELECT COUNT(*) FROM `users_online` WHERE `session_id` = %s AND `user_id` = %d AND `key` = %s";
      $sSql = sprintf($sSql, $this->_db->quote(session_id()),
                      $this->_user->id,
                      $this->_db->quote($this->_request['key'], 'text'));
      $result = $this->_db->queryOne($sSql, 'integer');
       // Always check that result is not an error
      
      if (PEAR::isError($result)) {
          GNY_Error::addError( $result->getMessage());
      } else {
          return $result > 0;
      }
    } else {
        return false;
    }
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