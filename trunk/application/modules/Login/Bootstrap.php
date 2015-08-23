<?php

class Login_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_name = 'login';

    function _initAcl() 
    {
        $registry = Zend_Registry::getInstance();
        $acl = $registry->get('acl');
        $this->_initIndexAcl($registry,$acl);
    }
    public function __initPath()
    {

    }

    private function _initIndexAcl($registry,$acl)
    {
        $resource_name = $this->_name . ':index';
        $acl->addResource($resource_name);
        $arrGuest = array(
                'index',   
                'logout'
        );
       
        $acl->allow(Core_Role::ROLE_GUEST, $resource_name, $arrGuest);        
        $registry->set('acl',$acl);
    }
}

