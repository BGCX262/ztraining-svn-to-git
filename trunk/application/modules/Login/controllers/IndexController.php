<?php
class Login_IndexController extends Zend_Controller_Action
{
    public function preDispatch()
    {
            
    }    
    public function indexAction()
    {     
         if(Zend_Auth::getInstance()->hasIdentity())
        {
            $this->_redirect('admin/index');
        }  
        
        // Create form login
        $form = new Login_Form_Login();
        $request = $this->getRequest();
        
        // Is post
        if ($request->isPost()) {
            if($form->isValid($request->getPost())) { 
                // Get values from form
                $user = $form->getValue('username');
                $password = $form->getValue('password');
                
                $authAdapter = $this->getAuthAdapter();
                $authAdapter->setIdentity($user)
                            ->setCredential($password);
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);                
                # is the user a valid one?
                if($result->isValid()){
                    # all info about this user from the login table
                    # ommit only the password, we don't need that
                    $userInfo = $authAdapter->getResultRowObject(null, 'password');

                    # the default storage is a session with namespace Zend_Auth
                    $authStorage = $auth->getStorage();
                    $authStorage->write($userInfo);

                    $this->_redirect('admin/index');
                }else {
                    $errorMessage = "Wrong username or password provided. Please try again.";
                }
            }
        }

        $errorMessage = "";
        
        // View
        $this->view->title = 'Login';
        $this->view->form = $form;

    }
    protected function getAuthAdapter()
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password')
                    ->setCredentialTreatment('MD5(?)');
                    
        return $authAdapter;
    }
    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect("login/index");
    }
}
?>