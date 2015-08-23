<?php

class Login_Form_Login extends Zend_Form 
{
    protected $_element_decorators = array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'div', 'class' => 'form_element')),
        array('Label', array('tag' => 'div', 'class' => 'form_label')),
    );
    
    public function init()
    {
        $this->setAttrib('id', 'form_login');
        $this->setMethod('post');

        $this->addElement('text', 'username', array(
            'label'    	=> 'Username',
            'required'	=> true,
            'validators' => array(
            array('NotEmpty', false, 
                array('messages' => array(
                    Zend_Validate_NotEmpty::IS_EMPTY => 'Username cannot be empty')
            )))
        ));        
        
        $this->addElement('password', 'password', array(
            'label'    	=> 'Password',
            'required'	=> true,
            'validators' => array(
            array('NotEmpty', false, 
                array('messages' => array(
                    Zend_Validate_NotEmpty::IS_EMPTY => 'Password cannot be empty')
            )))
        ));
        
        $this->addElement('submit', 'login',array(
            'label' => 'Sign in',
        ));
    }
}