<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        
        $u_email = new Zend_Form_Element_Text("u_email");
        $u_email->setLabel("Email");
        $u_email->setRequired();
        $u_email->addValidator(new Zend_Validate_EmailAddress());
        $u_password = new Zend_Form_Element_Password("u_password");
        $u_password->setLabel("Password : ");
        $u_password->setRequired();
        $u_password->addValidator(new Zend_Validate_StringLength(array('min' => 5, 'max' => 15)));
        $submit = new Zend_Form_Element_Submit("submit");
                
        $this->addElements(array($u_email,$u_password,$submit));
    }


}

