<?php
session_start();
error_reporting('E_ALL');
require_once '../application/bootstrap.php';

$_POST['action'] = 'online_list';
$_POST['uid'] = '110';
$_POST['name'] = 'jus';
$_POST['password'] = 'qwe123qwe';
$_POST['key'] = 'a5f8248d97245a71977079cbbc5f0619';
 

if (isset($_POST)){
	/* @var $gny GNY */
  $gny->process($_POST);
  
}
echo  $gny->getResponse();
$db->disconnect();
exit;