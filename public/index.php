<?php
require_once '../application/bootstrap.php';

if (isset($_POST)){
	/* @var $gny GNY */
  $gny->process($_POST);
}


var_dump(get_include_path()); exit;