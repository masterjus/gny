<?php
require_once 'JSON.php';

abstract class GNY_Abstract
{
  protected $_db;
  protected $_json;
  
  public function __construct()
  {
    $this->_db =& MDB2::singleton();
    $this->_json = new Services_JSON();
  }
}