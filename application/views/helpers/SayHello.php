<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 03/08/16
 * Time: 01:50 م
 */

/**
 * Action Helper for view
 */
class Zend_View_Helper_SayHello extends Zend_View_Helper_Abstract
{
    public function sayHello($yourName, $gender)
    {
        $greeting = $gender == "female" ? "Mrs" : "Mr";

        return "Welcome to My first Helper Function $greeting $yourName";

    }


}