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
        
        return $this->fetchAll($this->select()->from('user', array('u_id'))->where('u_password=?',$password)->where('u_id=?',$id))->toArray() ;

    }
      function checkusernewemail($useremail)
    {
           $select = $this->select()
                ->from(array('user'), //t1
                        array('u_email'))  //select cols from table
               
                ->where('u_email = ?',$useremail);
                
        $select->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();
        if(!$row){
            
            return true;
        }
        else{
            
            return FALSE;
        }
        
        
        

    }
      function  insertuser($email,$password,$username)
    {
     $newData = array('u_email'=> $email,'u_password'=>$password ,'u_name'=>$username);
      return $this->insert($newData);

          
          
    }
    
    


}

