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
}
