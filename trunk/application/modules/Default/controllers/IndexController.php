<?php
class IndexController extends Zend_Controller_Action
{
    public function preDispatch()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()){  
            // Redirect to
//            $this->_helper->redirector('index','index','login');			
            $this->_helper->redirector('index', 'index', 'admin');
        }        
    }
    public function indexAction()
    {           
       // View
        $this->view->module = "Default";
        $this->view->logout = "Logout";
   }
}