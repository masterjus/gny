<?php
require_once 'JSON.php';
require_once 'GNY_Memcache.php';

abstract class GNY_Abstract
{
  protected $_db;
  protected $_cache;
  
  public function __construct()
  {
    $this->_db =& MDB2::singleton();
  }
}