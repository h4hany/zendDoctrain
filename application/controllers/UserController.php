<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body

    }

    public function addAction()
    {
        // action body
        $data = $this->getRequest()->getParams();

        if ($_POST['oper'] == 'add') {


            $dev = new Model_Student();
            $dev->name = $data['name'];
            $dev->save();
        } elseif ($_POST['oper'] == 'edit') {

        }
    }

    public function updateAction()
    {
        $data = $this->getRequest()->getParams();

        $id = $data['id'];
        $name = $data['name'];

        $q = Doctrine_Query::create()
            ->update('Model_Student s')
            ->set('s.name', "'$name'")
            ->where("s.id = '$id'");
        $q->execute();

    }

    public function deleteAction()
    {
        // action body
        $data = $this->getRequest()->getParams();
        $id = $data['id'];
        $q = Doctrine_Query::create()
            ->delete('Model_Student s')
            ->where("s.id = $id");
        $q->execute();
    }

    public function jsonAction()
    {
        // action body
        //searchField=invid&searchString=123&searchOper=eq
        $searchField = $this->getRequest()->getParam("searchString");
        $searchString = $this->getRequest()->getParam("searchField");
        $searchOper = $this->getRequest()->getParam("searchOper");


        if (!isset($searchField)) {
            $q = Doctrine_Query::create()
                ->select("*")
                ->from("Model_Student ");


        } else {

            $operations = array(
                'eq' => "= ",            // Equal
                'ne' => "<> ",           // Not equal
                'lt' => "< ",            // Less than
                'le' => "<= ",           // Less than or equal
                'gt' => "> ",            // Greater than
                'ge' => ">= ",           // Greater or equal
                'bw' => "like ",       // Begins With
                'bn' => "not like ",   // Does not begin with
                'in' => "in ()",         // In
                'ni' => "not in ()",     // Not in
                'ew' => "like ",       // Ends with
                'en' => "not like ",   // Does not end with
                'cn' => "like ",     // Contains
                'nc' => "not like ", // Does not contain
                'nu' => "is null",           // Is null
                'nn' => "is not null"        // Is not null
            );
            $op = $operations[$searchOper];

            $q = Doctrine_Query::create()
                ->select("*")
                ->from("Model_Student ")->where("$searchField $op $searchString");
        }


        echo json_encode($q->fetchArray());

    }

    public function javaAction()
    {
        // action body
        $username = $this->getRequest()->getParam("username");
        $password = $this->getRequest()->getParam("password");



        $q = Doctrine_Query::create()
            ->select("*")
            ->from("Model_Student ")->where("username = $username ")->andWhere("password = $password");

        if ($q->getSqlQuery()) {

            echo "AUTH";

        } else {

            echo "not save";

        }
    }



    public function newAction()
    {
        // action body
        $type = $this->getRequest()->getParam("Type");
        $docNo = $this->getRequest()->getParam("DocumentNumber");
        $dof = $this->getRequest()->getParam("DateofBirth");
        $doe = $this->getRequest()->getParam("DateofExpiry");
        $iss = $this->getRequest()->getParam("Issuer");
        $national = $this->getRequest()->getParam("Nationality");
        $fname = $this->getRequest()->getParam("LastNames");
        $lname = $this->getRequest()->getParam("FirstNames");
        $gender = $this->getRequest()->getParam("Gender");
        echo $type . "\n";
        echo $docNo. "\n" ;
        echo $dof . "\n";
        echo $doe . "\n";
        echo $iss . "\n";
        echo $national. "\n" ;
        echo $fname . "\n";
        echo $lname . "\n";
        echo $gender. "\n" ;

        //            $passPort = new Model_Student();
//            $passPort->type = $type;
//            $passPort->docNo = $docNo;
//            $passPort->dof = $dof;
//            $passPort->doe = $doe;
//            $passPort->iss = $iss;
//            $passPort->national = $national;
//            $passPort->fname = $fname;
//            $passPort->lname = $lname;
//            $passPort->gender = $gender;
//            $passPort->save();
    }


}

























