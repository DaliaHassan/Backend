<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        $authorization =Zend_Auth::getInstance();
      if(!$authorization->hasIdentity()&&$this->_request->getActionName()!="login") {
             //->redirect("User/add");
       
    }
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
         
        if($this->getRequest()->isPost()){
        $u_email= $this->_request->getParam("u_email");

        $u_password= $this->_request->getParam("u_password");
        $db =Zend_Db_Table::getDefaultAdapter();
        $authAdapter=new Zend_Auth_Adapter_DbTable($db,'user','u_email','u_password');
        $authAdapter->setIdentity($u_email);
        $authAdapter->setCredential($u_password);
        $result = $authAdapter->authenticate();
         if ($result->isValid()) {
             $auth =Zend_Auth::getInstance();
             $storage = $auth->getStorage();
             $storage->write($authAdapter->getResultRowObject(array('u_email','u_id', 'u_name')));
             if($this->_request->getParam("u_email")=="admin@yahoo.com" ){
             $this->redirect("user/home");
                 echo"sucess";
             }
             else{
                 
               //  $this->redirect("Post/listpostofuser
                echo "not found";
             }
         }else{
                   echo "not found";
        }
        
         }
        else{
                   echo "not found";
        }
       // $this->render("add");
        
    }

    public function listuserAction()
    {
               
      $model=new Application_Model_User();
      $model1=$model->listUser(); 
      $this->view->alldata= $model1;

        
    }

    public function homeAction()
    {
        // action body
    }

    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity(); // to destroy session
        $this->redirect('user/login') ;
       
    }

    public function forgetpasswordAction()
    {
     if($this->getRequest()->isPost()){
            
                $email= $this->_request->getParam('u_email');
                $usermodel=new Application_Model_User();
                
                if($userid=$usermodel->checkuserEmail($email))
                {
                    
                       $newpassword = substr(hash('sha512',rand()),0,8);

                        
                            $smtpoptions=array(
                            'auth'=>'login',
                            'username'=>'shimaamohsen91@yahoo.com',
                            'password'=>'1212121212',
                            'ssl'=>'tls',
                            'port'=>587
                        );
                        $mailtransport=new Zend_Mail_Transport_Smtp('smtp.gmail.com',$smtpoptions);
                        $mail = new Zend_Mail();
                        $mail->addTo($email,'to You');
                        $mail->setSubject('Hello User');
                        $mail->setBodyText('Message from our Transportation your new password is'.$newpassword);
                        $mail->setFrom('asmaamohamedmagdhelali@gmail.com', 'Transportation');

                        //Send it!
                        $sent = true;
                        try {
                            $mail->send($mailtransport);
                        } catch (Exception $e){
                            echo $e;
                            $sent = false;
                        }

                        //Do stuff (display error message, log it, redirect user, etc)
                        if($sent){
                                if($usermodel->updateuseremail(md5($newpassword), $userid[0]['u_id']))
                                {
                                    echo 'successfully sent please check your Email';
                                }
                                else {
                                     echo 'error in server';
                                }
                                
                            
                        } else {
                            echo 'failed sending to your email please check your settings';
                        }
                    
                        
                    }
                    
                    
                
                else {
                    echo 'This email is not Existed in my database';
                }
            
    


}




    }


}










    
    
    
    
    
    
   



