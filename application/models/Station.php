<?php

class Application_Model_Station extends Zend_Db_Table_Abstract
{

   protected  $_name='station';

 function addstation($station_date){
     
     //echo $station_date;
     return $this->insert($station_date);
     
  }
         
 function  listallstation(){
             
      $select = $this->select()
                ->from(array('s' => 'station'), //t1
                        array('st_id','st_name','st_long','st_latt'))  //select cols from table
                ->join(array('a' => 'area'),//t2
                        's.st_area =a.area_id',  array('area_name'));
                

        $select->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();
        return $row;
             
             
  }
  
  function  listallstations()
  
  {
          return $this->fetchAll()->toArray();

  }
          
function deletetestation($stationid){
             
          
  return $this->delete("st_id=$stationid");

 }
         
function getdatabyid($st_id){
   $select = $this->select()
                ->from(array('s' => 'station'), //t1
                        array('st_id','st_name','st_long','st_latt','st_area'))  //select cols from table
                ->join(array('a' => 'area'),//t2
                        's.st_area =a.area_id',  array('area_name'))
                 ->where('st_id = ?', $st_id);

        $select->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();
        return $row;
        
        
  }
    
function editstation($stationdata){
     return $this->update($stationdata,"st_id=".$stationdata['st_id']);
            
 }
    
}


