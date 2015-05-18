<?php

class WebserviceController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listallareaAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $areamodel = new Application_Model_Area;
            $arearesult = $areamodel->listallarea();

            if ($arearesult) {
                for ($i = 0; $i < count($arearesult); $i++) {
                    $area = new Application_Model_Areadata();
                    $area->area_id = $arearesult[$i]['area_id'];
                    $area->area_name = $arearesult[$i]['area_name'];
                   


                    
                    array_push($json,$area);
                }

                echo json_encode(array('areas' => $json));
            } else {

                echo json_encode(array('areas' => $json));
            }
        }
    }

    public function loginserviceAction()
    {


        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            if ($_POST['phone'] != "" && $_POST['password'] != "") {

                $user = new Application_Model_User();

                $resultPhone = $user->checkuserphone($_POST['phone']);


                if ($resultPhone[0]) {

                    $resultPassword = $user->checkuserPassword(md5($_POST['password']), $resultPhone[0]['u_id']);


                    if ($resultPassword[0]) {

                        $json = array('status' => '1', 'user_id' => $resultPassword[0]['u_id']);
                        echo json_encode(array('logincontents' => $json));
                    } else {

                        $json = array('status' => '-1');
                        echo json_encode(array('logincontents' => $json));
                    }
                } else {
                    $json = array('status' => '0');
                    echo json_encode(array('logincontents' => $json));
                }
            } else {
                $json = array('status' => '-2');

                echo json_encode(array('logincontents' => $json));
            }
        } else {
            //echo $this->message = 'user not found';
            $json = array('status' => '-5');
            echo json_encode(array('logincontents' => $json));
        }
    }

    public function listmertotransportationAction()
    {
       $this->_helper->viewRenderer->setNoRender(true);
        $json = array();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $transportationmodel = new Application_Model_Transportationmean();
            $transportationresult = $transportationmodel->listallmetrotransportation();

           
            if ($transportationresult) {
                for ($i = 0; $i < count($transportationresult); $i++) {
                    $transportationmodeldata = new Application_Model_Transportationdata();
                    $transportationmodeldata->tr_id= $transportationresult[$i]['tr_id'];
                    $transportationmodeldata->tr_type= $transportationresult[$i]['tr_type'];
                    $transportationmodeldata->tr_numbername= $transportationresult[$i]['tr_number/name'];


                   // $json = array($transportationmodeldata);
                     array_push($json,$transportationmodeldata);
                }

                echo json_encode(array('$transportationmodeldata' => $json));
            } else {

                echo json_encode(array('$transportationmodeldata' => $json));
            }
        }
        
    }

    public function signupAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
                 

            if ($_POST['email'] != "" && $_POST['password'] != "") {
                
                

                 $myuser = new Application_Model_User();
           
                 
                 

                  $resultemail = $myuser->checkusernewemail($_POST['email']);
                 
                   if($resultemail){
                       
                       $myusermodel=new Application_Model_User();
                       
                       $myuser=$myusermodel->insertuser($_POST['email'],$_POST['email']);
                       
                        $json = array('status' => '1');
                        echo json_encode(array('signupcontents' => $json));
                       
                       
                       }
                   else{
                       $json = array('status' => '0');
                      echo json_encode(array('signupcontents' => $json));
                       
                       
                       
                       
                   }
                   }
                
                
                
            }

       
    }

    public function listallbustransportationAction()
    {
         $this->_helper->viewRenderer->setNoRender(true);
        $json = array();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $transportationmodel = new Application_Model_Transportationmean();
            $transportationresult = $transportationmodel->listallbustransportation();

          
            if ($transportationresult) {
                for ($i = 0; $i < count($transportationresult); $i++) {
                    $transportationmodeldata = new Application_Model_Transportationdata();
                    $transportationmodeldata->tr_id= $transportationresult[$i]['tr_id'];
                    $transportationmodeldata->tr_type= $transportationresult[$i]['tr_type'];
                    $transportationmodeldata->tr_numbername= $transportationresult[$i]['tr_number/name'];


                    array_push($json,$transportationmodeldata);
                }

                echo json_encode(array('$transportationmodeldata' => $json));
            } else {

                echo json_encode(array('$transportationmodeldata' => $json));
            }
        }
        
   }


}









