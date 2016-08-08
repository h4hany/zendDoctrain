<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 28/07/16
 * Time: 12:10 م
 */

define('APPLICATION_ENV', 'development');
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    './',
    get_include_path(),
)));

require_once '../library/Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->getBootstrap()->bootstrap('doctrine');

// set aggressive loading to make sure migrations are working
Doctrine_Manager::getInstance()->setAttribute(
    Doctrine::ATTR_MODEL_LOADING,
    Doctrine_Core::MODEL_LOADING_AGGRESSIVE
);

$options = $application->getBootstrap()->getOptions();
var_dump($options['resources']);
$cli = new Doctrine_Cli($options['doctrine_cfg']);

$cli->run($_SERVER['argv']);
