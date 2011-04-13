<?php

class GNY_User extends GNY_Abstract
{
  public $id;
  public $name;
  public $key;
  
  public function __construct( $userId = null) 
  {
    parent::__construct();
    $this->_table = 'users';
    $this->_pk = 'id';
    
    if ( null !== $userId ) {
      $this->load($userId);
    }
  }
  
  /**
   * @TODO Добавить передачу ключа и смену PK
   * @see GNY_Abstract::load()
   */
  public function load($id = null)
  {
     if (null !== $id )
         $this->id = $id;
         
     $this->loadByPk($this->id); 
  }
  
  public function authenticate( $data = array() )
  {
      if ( !$this->isAuthenticated() && !empty($data) ) {
          $sSql = 'SELECT * FROM `users` WHERE `name` = %s AND `password` = %s';
          $sSql = sprintf($sSql, $this->_db->quote($data['name']),$this->_db->quote(md5($data['password'])));
          $result =  $this->_db->queryRow($sSql, null, MDB2_FETCHMODE_ASSOC);
          
          if ( empty($result) ) {
              GNY_Error::addError('Authentication query error');
              return false;
          }  else {
              foreach ($result as $attrib => $value) 
                  $this->$attrib = $value;
              $this->startUserSession();
          }
      }
      return $this;
  }
  
  /*
   * Регистрация нового пользователя.
   * 
   * @return object GNY_User
   */
  public function register( $data = array() )
  {
      if ( !empty($data) ) {
        $sSql = 'INSERT INTO `users` (`name`, `password`, `registration_date`) VALUES (%s, %s, NOW())';
        $sSql = sprintf($sSql, $this->_db->quote($data['name'],'text'), $this->_db->quote(md5($data['password']),'text'));
        $res =& $this->_db->exec($sSql);
        
        // Always check that result is not an error
        if (PEAR::isError($res)) {
          GNY_Error::addError( $res->getMessage());
        } 
              
        $this->id = $this->_db->lastInsertID('users'); 
        if (!$this->startUserSession()) {
            GNY_Error::addError('Registration failure.');
        } else {
            $this->load();
        }
      }
    return $this;
  }
  
  public function startUserSession()
  {
    if ( $this->isAuthenticated() ) {
      $this->key = $this->_generateKey();
      $this->_db->loadModule('Function');
      $params = array('session_id' => array('value' => session_id(),
                                            'key' => true,
                                            'type' => 'text' ), 
                      'user_id' => array('value' => $this->id, 'key' => true), 
                      'key' => array('value' => $this->key, 'type' => 'text'),
                      'date_time' => array('value' => 'NOW()', 'type' => 'timestamp'));
     
      $res = $this->_db->replace( 'users_online', $params );
        // Always check that result is not an error
      
      if (PEAR::isError($res)) {
          GNY_Error::addError( $res->getMessage());
      } else {
          return true;
      }
    }
    return false;
  }
  
  public function isAuthenticated()
  {
    return null !== $this->id;
  } 
  
  /**
   * Генерирует уникальный ключ
   * 
   */
  private function _generateKey()
  {
    global $config;
    $keyLine = $config['secret']['key']. time();
    if (null !== $this->id){
      $keyLine .= $this->id;
    }
    $key = md5( sha1($keyLine) );
    //TODO Сохранить ключ в базу
    /*$query = $this->_db->escape('INSERT INTO _');
    $this->_db->query();
    */
    return $key;
  }
}
