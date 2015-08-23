<?php
set_time_limit(0);

// Define path to root directory
defined('BASE_PATH')
        || define('BASE_PATH', realpath(dirname(__FILE__)));

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__). '/../application'));

// Define application environment
// development
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
      
// Library
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(BASE_PATH . '/../../libraries'),	
    get_include_path(),
)));
echo realpath(BASE_PATH . '/../../libraries');

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    array(
    	'config' => realpath(APPLICATION_PATH . '/configs/application.ini')
    ));

$application
	->bootstrap()
	->run();
