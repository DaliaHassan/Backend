<?php

class Application_Model_Transportationmean extends Zend_Db_Table_Abstract
{

         protected  $_name='transportationmean';
         
         function addTransportationmean($transportation_data){
         return $this->insert($transportation_data);
         
     
         }
         
         function  listalltransportationmean(){
             
              return $this->fetchAll()->toArray();
             
             
         }
         
         function deleteteansportationmean($transportationid){
             
             return $this->delete("tr_id=$transportationid");
             
         }
         
         function getdatabyid($tr_id){
             
        
            if(isset($tr_id)){
            
            return $this->find($tr_id)->toArray();    
            }
        
        
        }
    
         
         function edittransportationmean($transportationid){
             
              return $this->update($transportationid,"tr_id=".$transportationid['tr_id']);
            
         }
         function  listallmetrotransportation(){
             
              $select = $this->select()
                ->from(array('transportationmean'), //t1
                        array('*'))  //select cols from table
               
                ->where('tr_type = ?','Metro');
                
        $select->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();
        return $row;
             
             
        
         }
         
          function  listallbustransportation(){
             
              $select = $this->select()
                ->from(array('transportationmean'), //t1
                        array('*'))  //select cols from table
               
                ->where('tr_type = ?','Bus');
                
        $select->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();
        return $row;
             
             
        
         }
    
}

