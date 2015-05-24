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
         function   liststation($areaname){
      
      $select = $this->select()->from(array('s' => 'station'), array('s.st_id','s.st_name','s.st_long','s.st_latt'))
        ->join(array('a' => 'area'),  's.st_area = a.area_id', array())
        ->join(array('p' => 'pass'), 'p.station_id = s.st_id', array())
        ->join(array('t' => 'transportationmean'), 't.tr_id = p.transportation_id', array("t.tr_type"))
        ->where("a.area_name =?" , $areaname)->setIntegrityCheck(false);
      


        return  $this->fetchAll($select)->toArray();
        

  }
  
  function  listmertostation(){
      
       $select = $this->select()->from(array('s' => 'station'), array('s.st_id','s.st_name','s.st_long','s.st_latt'))
        ->distinct()
        ->join(array('p' => 'pass'), 'p.station_id = s.st_id', array())
        ->join(array('t' => 'transportationmean'), 't.tr_id = p.transportation_id', array())
        ->where("t.tr_type =?" , 'Metro')->setIntegrityCheck(false);

        return  $this->fetchAll($select)->toArray();
        
      
  }
  function  listbusstation(){
      
       $select = $this->select()->from(array('s' => 'station'), array('s.st_id','s.st_name','s.st_long','s.st_latt'))
        ->distinct()
        ->join(array('p' => 'pass'), 'p.station_id = s.st_id', array())
        ->join(array('t' => 'transportationmean'), 't.tr_id = p.transportation_id', array())
        ->where("t.tr_type =?" , 'bus')->setIntegrityCheck(false);

        return  $this->fetchAll($select)->toArray();
        
      
  }
    function  listtypetransportationmean(){
             
              return $this->fetchAll()->toArray();
                      
             
             
         
    }
  
    
}

