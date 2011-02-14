<?php
require_once '../application/bootstrap.php';

if (isset($_POST)){
	/* @var $gny GNY */
  $gny->process($_POST);
}

echo  $gny->response();
exit;