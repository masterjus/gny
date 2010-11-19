<?php

define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH', dirname ( __FILE__ ));
define('LIB_PATH', APP_PATH. DS. '..'. DS. 'library');
define('PEAR_PATH', LIB_PATH. DS. 'PEAR');
define('CONFIG_PATH', APP_PATH. DS. '..'. DS. 'config');


set_include_path(get_include_path(). PATH_SEPARATOR. APP_PATH. PATH_SEPARATOR. LIB_PATH. PATH_SEPARATOR. PEAR_PATH);

global $db;
global $config;
global $json;

$config= parse_ini_file(CONFIG_PATH. DS. 'config.ini', true);

echo $connectionStr = 'mysqli://'. $config['server']['user']. ':'. $config['server']['password']. '@'. $config['server']['host']. '/'. $config['server']['db'];

require_once 'MDB2.php';
$options = array(
    'debug' => 2,
    'result_buffering' => false,
);
$db = MDB2::connect($connectionStr,$options);

require_once 'classes/GNY.php';
$gny = new GNY();

var_dump($config, $db); exit;