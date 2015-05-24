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
               // print_r($arearesult);
                for ($i = 0; $i < count($arearesult);$i++) {
                   
                    $area = new Application_Model_Areadata();
                    $area->area_id = $arearesult[$i]['area_id'];
                    $area->area_name = $arearesult[$i]['area_name'];
                   
                  array_push($json,$area);
                   // $json = array($area);
                }

                echo json_encode(array('areas' => $json));
            } else {

                echo json_encode(array('areas' => $json));
            }
        }
       // echo json_encode(array('areas' => $json));
    }
    
    public function listallstationsAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $stationsmodel = new Application_Model_Station;
            $stationsresult = $stationsmodel->listallstations();
            
            if ($stationsresult) {
                //print_r($stationsresult);
                for ($i = 0; $i < count($stationsresult);$i++) {
                   
                    $station = new Application_Model_Stationdata();
                    $station->st_id = $stationsresult[$i]['st_id'];
                    $station->st_name = $stationsresult[$i]['st_name'];
                    $station->st_long = $stationsresult[$i]['st_long'];
                    $station->st_latt = $stationsresult[$i]['st_latt'];


                   
                  array_push($json,$station);
                   // $json = array($area);
                }

                echo json_encode(array('stations' => $json));
            } else {

                echo json_encode(array('stations' => $json));
            }
        }
       // echo json_encode(array('areas' => $json));
    }

    public function loginserviceAction()
    {


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


                    //$json = array($transportationmodeldata);
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
                 

            if ($_POST['email'] != "" && $_POST['password'] != "" && $_POST['userName'] != "") {
         
           $myuser = new Application_Model_User();
           $resultemail = $myuser->checkusernewemail($_POST['email']);
                 
                   if($resultemail){
                       
                       $myusermodel=new Application_Model_User();
                       
                       $myuser=$myusermodel->insertuser($_POST['email'],$_POST['email'],$_POST['userName']);
                       
                        $json []= array('status' => '1','user_id'=>$myuser);
                        echo json_encode(array('signupcontents' => $json));
                       
                       
                       }
                   else{
                       $json[] = array('status' => '0');
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

    public function listmetrostationAction()
    {
         $this->_helper->viewRenderer->setNoRender(true);
         $json = array();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $transportationmodel = new Application_Model_Transportationmean();
         
       
            $transportationresult = $transportationmodel->listmertostation();
            if($transportationresult){
          
         
        
           for ($i = 0; $i < count($transportationresult); $i++) {
          $metrostationmodel=new Application_Model_Stationdata();
          $metrostationmodel->st_id=$transportationresult[$i]['st_id'];
          $metrostationmodel->st_name=$transportationresult[$i]['st_name'];
          $metrostationmodel->st_long=$transportationresult[$i]['st_long'];
          $metrostationmodel->st_latt=$transportationresult[$i]['st_latt'];
         // $metrostationmodel->st_type=$transportationresult[$i]['tr_type'];
       
          
         // array_push($json,$metrostationmodel);
          
       array_push($json,$metrostationmodel);
         // $json = array($metrostationmodel);
         }
          echo json_encode(array('metrostationmodel' => $json));
           } else {

               echo json_encode(array('metrostationmodel' => $json));
            }
          
          
          
        }
       

       
    }
    

    public function listareastationAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


           if ($_POST['source'] != "" && $_POST['destination'] != "") {
               
            $transportationmodel = new Application_Model_Transportationmean();
         
       
            $transportationresult = $transportationmodel->liststation($_POST['source']);
            
          
            if($transportationresult){
              
                 
           for ($i = 0; $i < count($transportationresult); $i++) {
          $metrostationmodel=new Application_Model_Stationdata();
          $metrostationmodel->st_id=$transportationresult[$i]['st_id'];
          $metrostationmodel->st_name=$transportationresult[$i]['st_name'];
          $metrostationmodel->st_long=$transportationresult[$i]['st_long'];
          $metrostationmodel->st_latt=$transportationresult[$i]['st_latt'];
          $metrostationmodel->st_type=$transportationresult[$i]['tr_type'];
       
          
         // array_push($json,$metrostationmodel);
          
       array_push($json,$metrostationmodel);
         // $json = array($metrostationmodel);
         }
          echo json_encode(array('metrostationmodel' => $json));
           } else {

               echo json_encode(array('metrostationmodel' => $json));
            }
          
          
          

        }
        else {

               echo json_encode(array('metrostationmodel' => $json));
            }
           }
    }

 public function forgetpasswordAction()
    {
        
        $this->_helper->viewRenderer->setNoRender(true);
        $json = array();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            
            if ($_POST['email'] != "" ) {
                $email= $_POST['email'];
                $usermodel=new Application_Model_User();
                $userid=$usermodel->checkuserEmail($email);
                if($userid[0])
                {
                    
                       $newpassword = substr(hash('sha512',rand()),0,8);

                        
                            $smtpoptions=array(
                            'auth'=>'login',
                            'username'=>'asmaamohamedmagdhelali@gmail.com',
                            'password'=>'asmaa2961991',
                            'ssl'=>'tls',
                            'port'=>587
                        );
                        $mailtransport=new Zend_Mail_Transport_Smtp('smtp.gmail.com',$smtpoptions);
                        $mail = new Zend_Mail();
                        $mail->addTo($email,'to You');
                        $mail->setSubject('Hellow User');
                        $mail->setBodyText('message from our Transportation App your new password is'.$newpassword);
                        $mail->setFrom('asmaamohamedmagdhelali@gmail.com', 'Transportation App');
                        
                        //Send it!
                        $sent = true;
                        try {
                            $mail->send($mailtransport);
                            
                        } catch (Exception $e){
                            
                            $sent = false;
                        }

                        //Do stuff (display error message, log it, redirect user, etc)
                        if($sent){
                                if($usermodel->updateuseremail(md5($newpassword), $userid[0]['u_id']))
                                {
                                    $json []= array('status' => '1');//correct sending
                                    echo json_encode(array('forgetpasswordcontents' => $json));
                                }
                                else {
                                     $json []= array('status' => '-2');//error in server smtp
                                    echo json_encode(array('forgetpasswordcontents' => $json));
                                }
                                
                            
                        } else {
                            echo 'failed sending to your email please check your settings';
                        }
                    
                        
                    }
                    
                    
                
                else {
                    $json []= array('status' => '-1');// not avalid email
                     echo json_encode(array('forgetpasswordcontents' => $json));
                }
            }
            else {
                    $json []= array('status' => '-6');// not avalid email
                     echo json_encode(array('forgetpasswordcontents' => $json));
                }
        }
        else {
                    $json []= array('status' => '-7');// not avalid email
                     echo json_encode(array('forgetpasswordcontents' => $json));
                }
        
                }
                
                
                
      public function listbusstationAction()
    
     {

        
         $this->_helper->viewRenderer->setNoRender(true);
        $json = array();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $transportationmodel = new Application_Model_Transportationmean();
         
       
            $transportationresult = $transportationmodel->listbusstation();
            if($transportationresult){
          
         
        
           for ($i = 0; $i < count($transportationresult); $i++) {
          $metrostationmodel=new Application_Model_Stationdata();
          $metrostationmodel->st_name=$transportationresult[$i]['st_name'];
          $metrostationmodel->st_long=$transportationresult[$i]['st_long'];
         $metrostationmodel->st_latt=$transportationresult[$i]['st_latt'];
         // $metrostationmodel->st_type=$transportationresult[$i]['tr_type'];
       
          
         // array_push($json,$metrostationmodel);
          
       array_push($json,$metrostationmodel);
         // $json = array($metrostationmodel);
         }
          echo json_encode(array('metrostationmodel' => $json));
           } else {

               echo json_encode(array('$metrostationmodel' => $json));
            }
          
          
          
        }
       

       
    }


      

}
















