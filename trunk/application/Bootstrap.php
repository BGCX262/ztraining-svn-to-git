<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * 
     */
    protected function _initModules() 
    {
        $front = $this->bootstrap("frontController")->frontController;            
        $modules = $front->getControllerDirectory();        
        $default = $front->getDefaultModule();      
        
        set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . '/modules/');
        
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $controllers = array();
        
        foreach (array_keys($modules) as $module) {
            $directory = $front->getModuleDirectory($module);
            $controllers[strtolower($module)] = $directory . '/controllers';			

            // init auto loader
            $autoloader->pushAutoloader(new Zend_Application_Module_Autoloader(array(
                'namespace' => ucwords($module),
                'basePath' => $directory,
                'resourceTypes' => array(
                    'model' => array(
                    'path'      => 'models/',
                    'namespace' => 'Model',
                ))
            )));     
            // init auto loader namspace
            $autoloader->registerNamespace($module . '_');            
        }   	
        $front->setControllerDirectory($controllers);        
    } 
    
     protected function _initAcl() 
    {    	
    	$acl = new Zend_Acl();
    	
    	$acl->addRole(new Zend_Acl_Role(Core_Role::ROLE_GUEST));
    	$acl->addRole(new Zend_Acl_Role(Core_Role::ROLE_USER), Core_Role::ROLE_GUEST);
    	
    	$acl->addResource('default:index');    	
    	$acl->allow(Core_Role::ROLE_GUEST, 'default:index', 'index');
    
		$registry = Zend_Registry::getInstance();
    	$registry->set('acl', $acl);
    }
}