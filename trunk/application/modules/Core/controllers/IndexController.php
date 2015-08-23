<?php
class Core_IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->controller = '<h3>Core</h3><br>';
        $tbUsers = new Core_Model_DbTable_Users();
        $users = $tbUsers->getUsers();
        
        foreach($users as $user)
        {
            echo $user->username.'<br>';
        }    
        
        // View
        $this->view->module = 'Core';
    }
}
?>