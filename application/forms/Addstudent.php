<?php

class Application_Form_Addstudent extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');
        $this->setAction('/user/add');
        $student_name = new Zend_Form_Element_Text("student_name");
        $student_name->setRequired();
        $student_name->addValidator(new Zend_Validate_Alpha());
        $student_name->setLabel("student Name:");
        $student_name->setAttrib("class",array("form-control","col-lg-9" ));
        $student_name->setAttrib("placeholder","Enter student name");



        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $submit->setAttrib("value", "add");
        $this->setAttrib('class','form-horizontal');
        $this->addElements(array($student_name ,$submit ));

    }


}

