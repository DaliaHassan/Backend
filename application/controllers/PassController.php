<?php

class PassController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addpassAction()
    {
        
      $transportationmodel=new Application_Model_Transportationmean();
      $this->view->alltransportation=$transportationmodel->listalltransportationmean(); 
        
      $stationmodel=new Application_Model_Station();
      $this->view->allstation=$stationmodel->listallstation();
      
      
      
       if($this->getRequest()->isPost()){
         $data=$this->getRequest()->getParams();
        
         
                   
           unset($data['controller']);
           unset($data['module']);
           unset($data['action']);
           unset($data['Post']);
           
           
           $model=new Application_Model_Pass();
         
//           print_r($data);
            
            $mydata=$model->addpass($data);
           
            if($mydata){
               
                
                $this->redirect("pass/listpass");
           

                 }
                 
            else{
                
                  $this->view->error="Error!";
                  $this->redirect("pass/listpass");
                
            }
           
           
       } 
       
       
        
        
      
    }

    public function listpassAction()
    {
       $model=new Application_Model_Pass();
       $allpass=$model->listallpass();
       
       $this->view->alldataofpass= $allpass;
    }

    public function deletepassAction()
    {
       $model=new Application_Model_Pass();
       $transportationid=$this->getRequest()->getParam('transportation_id');
      
       $stationid=$this->getRequest()->getParam('station_id');
       $modelid=$model->deletepass($transportationid,$stationid); 
       $this->redirect("/pass/listpass");
    }

    public function updatapassAction()
    {
      $station_id=$this->getRequest()->getParam("station_id");  
      $transportation_id=$this->getRequest()->getParam("transportation_id"); 
      $model=new Application_Model_Pass();
      $passdata=$model->getdatabystationid($station_id,$transportation_id);  
      $this->view->mypassdata = $passdata;
      
      
      
      $transportationmodel=new Application_Model_Transportationmean();
      $this->view->alltransportation=$transportationmodel->listalltransportationmean(); 
       
      $stationmodel=new Application_Model_Station();
      $this->view->allstation=$stationmodel->listallstation();
      
   
     
     
      $data=$this->getRequest()->getParams();
       if($this->getRequest()->isPost()){
         $data=$this->getRequest()->getParams();
      
           unset($data['controller']);
           unset($data['module']);
           unset($data['action']);
           unset($data['Post']);
           
   
        $model->updatepass($data); 
        
        $this->redirect("pass/listpass");
     
       }
    }
    
    }












