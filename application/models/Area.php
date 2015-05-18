<?php

class Application_Model_Area extends Zend_Db_Table_Abstract

{
    protected  $_name='area';
     function  listallarea(){
             
      return $this->fetchAll()->toArray();
             
             
  }

}

