<?php

class TransportationmeanController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addtransortationAction()
    {
         if($this->getRequest()->isPost()){
               
           $data=$this->getRequest()->getParams();
           unset($data['controller']);
           unset($data['module']);
           unset($data['action']);
           unset($data['Post']);
           $model=new Application_Model_Transportationmean();
           
           $model->addTransportationmean($data);
           $this->redirect("/transportationmean/viewtransortation");

 
           }
 else {
               echo 'hi';
     
 }
           
    }

    public function viewtransortationAction()
    {
              
      $model=new Application_Model_Transportationmean();
      $alltransportationmean=$model->listalltransportationmean(); 
      $this->view->alldataoftransportation= $alltransportationmean;
    }

    public function deletetransortationAction()
    {
        
      
               
       $model=new Application_Model_Transportationmean();
       $id=$this->getRequest()->getParam('tr_id');
       $modelid=$model->deleteteansportationmean($id); 
       $this->redirect("/transportationmean/viewtransortation");
      



    }

    public function edittransortationAction()
    {
      $tr_id=$this->getRequest()->getParam("tr_id");          
      $model=new Application_Model_Transportationmean();
      $transportationdata=$model->getdatabyid($tr_id);  
      $this->view->mytransportationdata = $transportationdata;
      
      //print_r($transportationdata);
    
      $data=$this->getRequest()->getParams();
     
       if($this->getRequest()->isPost()){
         $data=$this->getRequest()->getParams();
         print_r($data);
           unset($data['controller']);
           unset($data['module']);
           unset($data['action']);
           unset($data['Post']);
       // $data=$form->getValues();
        $model->edittransportationmean($data); 
        
        $this->redirect("/transportationmean/viewtransortation");
     
       }
       
    }


}







