<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 03/08/16
 * Time: 01:50 م
 */

/**
 * Action Helper for finding days in a month
 */
class Dc_Helper_SayHello extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * @var Zend_Loader_PluginLoader
     */
    public $pluginLoader;

    /**
     * Constructor: initialize plugin loader
     *
     * @return void
     */
    public function __construct()
    {
        $this->pluginLoader = new Zend_Loader_PluginLoader();
    }

    public function getHelloMsg($yourName, $gender)
    {
        $greeting = $gender == "female" ? "Mrs" : "Mr";

        return "Welcome to My first Helper Function $greeting $yourName";

    }

    /**
     * Strategy pattern: call helper as broker method
     *
     * @param  string $yourName
     * @param  string $gender
     * @return string
     */
    public function direct($yourName, $gender)
    {
        return $this->getHelloMsg($yourName, $gender);
    }
}