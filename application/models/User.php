<?php

class Application_Model_User extends Zend_Db_Table_Abstract 
{
    protected  $_name='user';
    
      function listUser(){
    return $this->fetchAll()->toArray();
        
        
        
        
    }
      function  checkuserEmail($email)
    {
        return $this->fetchAll($this->select()->from('user', array('u_id'))->where('u_email=?',$email))->toArray() ;
    }
    
     function  updateuseremail($newpassword,$id)
    {
        return $this->update(array('u_password'=>$newpassword),"u_id=".$id);
    }
    
     function  checkuserphonepassword($phone, $password)
    {
        return $this->fetchAll($this->select()->from('user', array('u_id'))->where('u_phone=?',$phone)->where('u_password=?',$password))->toArray() ;
    }

    
    function checkuserPassword($password,$id)
    {
        
        return $this->fetchAll($this->select()->where('u_password=?',$password)->where('u_id=?',$id))->toArray() ;

    }
    
    
    


}

