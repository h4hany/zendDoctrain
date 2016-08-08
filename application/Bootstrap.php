<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initDoctrine()
    {
        Zend_Controller_Action_HelperBroker::addPrefix('Dc_Helper');
        require_once 'Doctrine/Doctrine.php';
        //Get a Zend Autoloader instance
        $loader = Zend_Loader_Autoloader::getInstance();

        //Autoload all the Doctrine files
        $loader->pushAutoloader(array('Doctrine', 'autoload'));
        spl_autoload_register(array('Doctrine', 'modelsAutoload'));

        //Get the Doctrine settings from application.ini
        $doctrineConfig = $this->getOption('doctrine_cfg');

        //Get a Doctrine Manager instance so we can set some settings
        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);
        Doctrine::loadModels(array($doctrineConfig['models_path']));
        //connect to database
        $manager->openConnection($doctrineConfig['connection_string'], 'pgsql');

        //set to utf8

        $manager->connection()->setCharset('utf8');

        Zend_Registry::set('Doctrine_Manager', $manager);

        return $manager;
    }

    protected function _initAutoload()
    {
        // Add autoloader empty namespace
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'basePath' => APPLICATION_PATH,
            'namespace' => '',
            'resourceTypes' => array(
                'model' => array(
                    'path' => 'models/',
                    'namespace' => 'Model_'
                )
            ),
        ));
        // Return it so that it can be stored by the bootstrap
        return $autoLoader;
    }

}
