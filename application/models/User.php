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
    
    
    function checkuserphone($phone)
    {
       
        return $this->fetchAll($this->select()->from('user', array('u_id'))->where('u_phone=?',$phone))->toArray() ;

    }
    
    function checkuserPassword($password)
    {
         return $this->fetchAll($this->select()->from('user', array('u_id'))->where('u_password=?',$password))->toArray() ;

    }
    
    
    


}

