<?php
/**
 * Description of authentication
 *
 * @author fragote
 */
namespace Business\Plugin;

  
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Authentication\AuthenticationService;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Session\Container;

class Authentication extends AbstractPlugin
{
    protected $_acl;
    protected $_user;
    protected $appl;
    
    public function __construct($appl)
    {
        $this->appl = $appl;
    }
    
    public function isAuthtenticated()
    {
        $controller = $this->getController();
        $controllerClass = get_class($controller);
        $namespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $moduleName = 'Cobranza';
        
        if ($controllerClass !== $namespace . "\Controller\LoginController" && $namespace === $moduleName){
            $auth = new AuthenticationService();
            if (!$auth->hasIdentity()) {
                $redirector = $controller->getPluginManager()->get('Redirect');
                return $redirector->toRoute(strtolower($namespace) . '-login');
            }
            
            $this->reviewAcl(strtolower($moduleName), $controller);
        }
    }
    
    public function reviewAcl($moduleName, $controllerInstance) 
    {  
        /*
        $routeMatch = $controllerInstance->getServiceLocator()
                                         ->get('application')
                                         ->getMvcEvent()
                                         ->getRouteMatch();
        $actionName = $routeMatch->getParam('action', 'index');
        $controllerName = $routeMatch->getParam('__CONTROLLER__', 'index');
        
        $this->_user = $sessionUsuario = new Container('usuario');
        $accesoUsuario = new Container('menu_acceso');
        $roleAnonimo = new GenericRole('anonimo');
        $role = new GenericRole($sessionUsuario->rolId);
        $objAcl = new Acl();
        
        $objAcl->deny();
        $objAcl->addRole($roleAnonimo);
        $objAcl->addRole($role, 'anonimo');
        $objAcl->addResource($moduleName);
        $objAcl->allow('anonimo', $moduleName, 'index:index');
        $objAcl->allow('anonimo', $moduleName, 'modal-login:administrador');
        $objAcl->allow('anonimo', $moduleName, 'modal-login:valida-administrador');
     
        $dataAcceso = unserialize($accesoUsuario->data);
       
        foreach ($dataAcceso as $acceso) {
            $actionTmp = !empty($acceso['action']) ? $acceso['action'] : 'index';
            $controllerTmp = !empty($acceso['controller']) ? $acceso['controller'] : 'index';
            $objAcl->allow($sessionUsuario->rolId, $moduleName, $controllerTmp . ':' . $actionTmp);
        }
        
        $this->_acl = $objAcl;
     
        if (!$objAcl->isAllowed($role, $moduleName, $controllerName . ':' . $actionName)) {
            $response = $controllerInstance->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $controllerInstance->getRequest()->getBaseUrl() . '/404');
            $response->setStatusCode(404);
        }
         */
    }
    
    public function getAcl()
    {
        return $this->_acl;
    }
    
    /**
     * 
     * @return mixed
     */
    public function getRolId()
    {
        $rtn = 0;
        if (get_class($this->_user) === 'Zend\Session\Container') {
            $rtn = $this->_user->rolId;
        }
        
        return $rtn;
    }
}