<?php

class GNY_User extends GNY_Abstract
{
  public function __construct( $userId = null) {
    parent::__construct();
    if ( null !== $userId ) {
      $this->loadByPk($userId);
    }
  }
  
  public function loadByPk($userId)
  {
    
  }
  
  public function authenticate()
  {
    
  }
  
  public function register()
  {
    
  }
  
  /**
   * Генерирует уникальный ключ
   * 
   */
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
}
