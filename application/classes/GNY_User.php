<?php

class GNY_User extends GNY_Abstract
{
  private $id;
  private $name;
  private $key;
  
  public function __construct( $userId = null) {
    parent::__construct();
    $this->_table = 'users';
    $this->_pk = 'id';
    
    if ( null !== $userId ) {
      $this->loadByPk($userId);
    }
  }
  

  
  public function authenticate()
  {
    
  }
  
  public function register($data = array())
  {
    if (!empty($data)) {
      
      $this->name = $data['name'];
      
    }
  }
  
  protected function startUserSession()
  {
    if ( $this->isAuthenticated()) {
      $this->key = $this->_generateKey();
    }
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
    $key = sha1($keyLine);
    //TODO Сохранить ключ в базу
    /*$query = $this->_db->escape('INSERT INTO _');
    $this->_db->query();
    */
    return $key;
  }
}
