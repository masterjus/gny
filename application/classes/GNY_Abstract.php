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
    $this->_db->options['debug'] = 0;
    $this->_db->options['debug_handler'] = 'vd';
  }
  
  public function loadByPk($value=null)
  {
    if (null !== $value) {
      $sSql = "SELECT * FROM `%s` WHERE `%s`='%s'";
      $sSql = sprintf($sSql, $this->_table, $this->_pk, $value);
      
      /* @var $result MDB2_Result_mysql */
      $result = $this->_db->query($sSql);
        
      $columns = $result->getColumnNames();

      $row = $result->fetchRow(MDB2_FETCHMODE_ASSOC);
      foreach ($row as $name => $value) {
          $this->$name = $value;
      }
      $result->free();
    }
    return $this;
  }
  
  public abstract function load();
}