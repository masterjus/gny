<?php
session_start();
error_reporting('E_ALL');
require_once '../application/bootstrap.php';

$_POST['action'] = 'auth';
//$_POST['uid'] = '110';
$_POST['name'] = 'jus';
$_POST['password'] = 'qwe123qwe';
//$_POST['key'] = '2ff36911b9954d614b8c5e48990fea5b';
 

if (isset($_POST)){
	/* @var $gny GNY */
  $gny->process($_POST);
  
}
echo  $gny->getResponse();
$db->disconnect();
exit;