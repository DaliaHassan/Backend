<?php

class WebserviceController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }
    

    public function listallstationAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $staionmodel = new Application_Model_Station();
            $stationresult = $staionmodel->listallstation();

            if ($stationresult) {
                for ($i = 0; $i < count($stationresult); $i++) {
                    $station = new Application_Model_Stationdata();
                    $station->st_id = $stationresult[$i]['st_id'];
                    $station->st_name = $stationresult[$i]['st_name'];
                    $station->st_long = $stationresult[$i]['st_long'];
                    $station->st_latt = $stationresult[$i]['st_latt'];


                    $json[] = array($stationresult[$i]['st_name'] => $station);
                }

                echo json_encode(array('stations' => $json));
            } else {

                echo json_encode(array('no_results' => $json));
            }
        }
    }

    public function loginserviceAction() {


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

}
