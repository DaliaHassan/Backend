<?php

class WebserviceController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }
    

    public function listallareaAction() {
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
                   


                    $json = array($area);
                }

                echo json_encode(array('areas' => $json));
            } else {

                echo json_encode(array('areas' => $json));
            }
        }
    }    public function loginserviceAction() {


        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            
            if ($_POST['email'] != "" && $_POST['password'] != "") {

                

                $user = new Application_Model_User();

                $resultEmail = $user->checkuserEmail($_POST['email']);

                
                if ($resultEmail[0]) {

                    
                    $resultPassword = $user->checkuserPassword(md5($_POST['password']), $resultEmail[0]['u_id']);


                    if ($resultPassword[0]) {

                        
                        $json [] = array('status' => '1', 'user_id' => $resultPassword[0]['u_id'],'user_name'=> $resultPassword[0]['u_name'],'user_password'=> $resultPassword[0]['u_password'], 'user_email'=> $resultPassword[0]['u_email'], 'user_phone'=> $resultPassword[0]['u_phone'], 'user_image'=> $resultPassword[0]['u_image'] );
                        echo json_encode(array('logincontents' => $json));
                    } else {

                        $json []= array('status' => '-1');
                        echo json_encode(array('logincontents' => $json));
                    }
                } else {
                    $json []= array('status' => '0');
                    echo json_encode(array('logincontents' => $json));
                }

                
                
            } else {
                $json []= array('status' => '-2');

                echo json_encode(array('logincontents' => $json));
            }
        } else {
            //echo $this->message = 'user not found';
            $json []= array('status' => '-5');
            echo json_encode(array('logincontents' => $json));
        }
    }

}
