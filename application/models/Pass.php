<?php

class Application_Model_Pass extends Zend_Db_Table_Abstract
{

    protected $_name='pass';
    
    function addpass($data){
        try {
            return $this->insert($data);
            
        } catch (Exception $exc) {
            return NULL;
        }



        
     
  }
    

    
    function getdatabystationid($stationid,$transportationid){
         
        $select = $this->select()->from(array('s' => 'station'), array('s.st_name','s.st_id'))
        ->distinct()
        ->join(array('p' => 'pass'), 'p.station_id = s.st_id', array("p.pass_status","p.pass_transportation_number"))
        ->join(array('t' => 'transportationmean'), 't.tr_id = p.transportation_id', array("*"))
        ->where("p.station_id  =?" ,$stationid)
        ->where("p.transportation_id=?",$transportationid)->setIntegrityCheck(false);
 

        return  $this->fetchAll($select)->toArray();
        
        
    }
    function updatepass($data){
        $where=array('station_id=?'=>$data['station_id'],'transportation_id=?'=>$data['transportation_id']
            );
          $data['station_id'] = $data['stationid'];
          $data['transportation_id'] = $data['transportationid'];
           unset($data['stationid']);
           unset($data['transportationid']);
           var_dump($where);
           var_dump($data);
            //die(); 
           $this->update($data, $where);
        
        
    }
    function listallpass(){
        
        $select = $this->select()->from(array('s' => 'station'), array('s.st_name','s.st_id'))
        ->distinct()
        ->join(array('p' => 'pass'), 'p.station_id = s.st_id', array("p.pass_status","p.pass_transportation_number"))
        ->join(array('t' => 'transportationmean'), 't.tr_id = p.transportation_id', array("*"))->setIntegrityCheck(false);
        

        return  $this->fetchAll($select)->toArray();
        
        
        
    }
    function deletepass($transportationid,$stationid){
        
        
        return $this->delete( array('station_id=?'=>$stationid,'transportation_id=?'=>$transportationid));
        
        
    }
    

}
