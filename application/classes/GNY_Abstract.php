<?php
require_once 'JSON.php';
require_once 'GNY_Memcache.php';

abstract class GNY_Abstract
{
  /**
   * @var MDB2_Driver_mysqli
   */
  protected $_db;
  protected $_cache;
  protected $_table;
  protected $_pk;
  
  public function __construct()
  {
    $this->_db =& MDB2::singleton();
  }
  
  public function loadByPk($value=null)
  {
    if (null != $value) {
      $sSql = "SELECT * FROM `%s` WHERE `%s`='%s'";
      $sSql = sprintf($sSql, $this->_table, $this->_pk, $value);
      return $result = $this->_db->queryRow($sSql);
    }
  }
  
}