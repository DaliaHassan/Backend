<?php

class Application_Model_Station extends Zend_Db_Table_Abstract
{

   protected  $_name='station';

 function addstation($station_date){
     
     echo $station_date;
     return $this->insert($station_date);
     
  }
         
 function  listallstation(){
             
      return $this->fetchAll()->toArray();
             
             
  }
         
function deletetestation($stationid){
             
  return $this->delete("st_id=$stationid");
 }
         
function getdatabyid($st_id){
             
    if(isset($st_id)){
            
    return $this->find($st_id)->toArray();    
    }
        
        
  }
    
function editstation($stationdata){
     return $this->update($stationdata,"st_id=".$stationdata['st_id']);
            
 }
    
}


