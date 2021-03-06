<?php
/**
 * Description of ACL
 *
 * @author fragote
 */

namespace Business\Plugin;
  
use Zend\Mvc\Controller\Plugin\AbstractPlugin,
    Zend\Session\Container as SessionContainer,
    Zend\Permissions\Acl\Acl,
    Zend\Permissions\Acl\Role\GenericRole as Role,
    Zend\Permissions\Acl\Resource\GenericResource as Resource;
     
class Privileges extends AbstractPlugin
{
    protected $sesscontainer ;
 
    private function getSessContainer()
    {
        if (!$this->sesscontainer) {
            $this->sesscontainer = new SessionContainer('aclMenu');
        }
        return $this->sesscontainer;
    }
     
    // @deprecated this is not used anymore!
    public function doAuthorization()
    {
        //setting ACL...
        $acl = new Acl();
        //add role ..
        $acl->addRole(new Role('anonymous'));
        $acl->addRole(new Role('user'),  'anonymous');
        $acl->addRole(new Role('admin'), 'user');
         
        $acl->addResource(new Resource('Panel'));
        $acl->addResource(new Resource('Login'));
         
        $acl->deny('anonymous', 'Panel', 'view');
        $acl->allow('anonymous', 'Login', 'view');
         
        $acl->allow('user',
            array('Panel'),
            array('view')
        );
         
        //admin is child of user, can publish, edit, and view too !
        $acl->allow('admin',
            array('Panel'),
            array('publish', 'edit')
        );
         
        $controller = $this->getController();
        $controllerClass = get_class($controller);
        $namespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
         
        $role = (!$this->getSessContainer()->role ) ? 'anonymous' : $this->getSessContainer()->role;
        if (!$acl->isAllowed($role, $namespace, 'view') && $controllerClass !== $namespace . "\Controller\LoginController"){
//            $redirector = $controller->getPluginManager()->get('Redirect');
//            return $redirector->toRoute('dash_logout');
        }
    }
}