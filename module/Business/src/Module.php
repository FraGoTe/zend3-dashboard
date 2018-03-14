<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Business;

use Dashboard\Navigation\MenuFactory;
use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
/*
   public function onBootstrap(MvcEvent $e)
   {
      $eventManager = $e->getApplication()->getEventManager();
      $eventManager->attach('route', array($this, 'onRouteFinish'), -100);
   }

   public function onRouteFinish($e)
   {
      $matches    = $e->getRouteMatch();
      $controller = $matches->getParam('controller');
      var_dump($matches);die();
   }
   */

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        $sharedManager = $eventManager->getSharedManager();

        //Setting View Helper
        $viewHelperManager = $e->getApplication()->getServiceManager()->get('ViewHelperManager');
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setFactory('FlashMsg', function() use ($viewHelperManager) {
            $viewHelper = new View\Helper\FlashMsg(
                $viewHelperManager->get('FlashMessenger'),
                $viewHelperManager->get('inlinescript'),
                $viewHelperManager->get('HeadLink'),
                $viewHelperManager->get('url')
            );

            return $viewHelper;
        });

        //Setting layouts
        $sharedManager->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config = $e->getApplication()->getServiceManager()->get('config');

            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }, 100);

        $router = $sm->get('router');
        $request = $sm->get('request');
        $matchedRoute = $router->match($request);
        if (null !== $matchedRoute) {
            //Check the Authentication in every controller different with Login
            //If there is no identity this will redirect to Login
            $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function() use ($sm) {
                $sm->get('ControllerPluginManager')->get('ModuleConditionalLoader')->isModuleAllowed();
            }, 2);
            $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function() use ($sm) {
                $sm->get('ControllerPluginManager')->get('Authentication')->isAuthtenticated();
            }, 2);
        }
    }

    public function getControllerPluginConfig()
    {
        return [
            'factories' => [
                'ModuleConditionalLoader' => function($serviceManager) {
                    $config = $serviceManager->get('Config');
                    $appPlugin = new \Business\Plugin\ModuleConditionalLoader($config);
                    return $appPlugin;
                },
                'Authentication' => function($serviceManager) {
                    $config = $serviceManager->get('Config');
                    $appPlugin = new \Business\Plugin\Authentication($config);
                    return $appPlugin;
                },
            ]
        ];
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\Modulo::class => function($container) {
                    $tableGateway = $container->get(Model\ModuloTable::class);

                    return new Model\ModuloTable($tableGateway);
                },
                Model\ModuloTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Modulo());
                    return new TableGateway('module', $dbAdapter, null, $resultSetPrototype);
                },
               Model\Privilege::class => function($container) {
                  $tableGateway = $container->get(Model\PrivilegeTable::class);

                  return new Model\PrivilegeTable($tableGateway);
               },
               Model\PrivilegeTable::class => function ($container) {
                  $dbAdapter = $container->get(AdapterInterface::class);
                  $resultSetPrototype = new ResultSet();
                  $resultSetPrototype->setArrayObjectPrototype(new Model\Privilege());
                  return new TableGateway('privilege', $dbAdapter, null, $resultSetPrototype);
               },
                Model\Rol::class => function($container) {
                    $tableGateway = $container->get(Model\RolTable::class);

                    return new Model\RolTable($tableGateway);
                },
                Model\RolTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Rol());
                    return new TableGateway('role', $dbAdapter, null, $resultSetPrototype);
                },
                Model\User::class => function($container) {
                    $tableGateway = $container->get(Model\UserTable::class);
                    $fktable = [
                        'rol' => $container->get(Model\RolTable::class)
                    ];
                    return new Model\UserTable($tableGateway, $fktable);
                },
                Model\UserTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Menu::class => function($container) {
                    $tableGateway = $container->get(Model\MenuTable::class);
                    $fktable = [
                        'modulo' => $container->get(Model\ModuloTable::class)
                    ];
                    return new Model\MenuTable($tableGateway, $fktable);
                },
                Model\MenuTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Menu());
                    return new TableGateway('menu', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Privilege::class => function($container) {
                    $tableGateway = $container->get(Model\PrivilegeTable::class);
                    $fktable = [
                        'menu' => $container->get(Model\MenuTable::class)
                        ];
                    return new Model\PrivilegeTable($tableGateway, $fktable);
                },
                Model\PrivilegeTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Privilege());
                    return new TableGateway('privilege', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
}
