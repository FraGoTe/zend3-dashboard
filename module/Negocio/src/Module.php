<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Negocio;

use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
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
                    $appPlugin = new \Negocio\Plugin\ModuleConditionalLoader($config);
                    return $appPlugin;
                },
                'Authentication' => function($serviceManager) {
                    $config = $serviceManager->get('Config');
                    $appPlugin = new \Negocio\Plugin\Authentication($config);
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
                Model\PaqueteTuristico::class => function($container) {
                    $tableGateway = $container->get(Model\PaqueteTuristicoTable::class);
                    $fk = [
                        'nacionalidad' => $container->get(Model\NacionalidadTable::class),
                        'tipo_documento' => $container->get(Model\TipoDocumentoTable::class),
                        'categoria' => $container->get(Model\CategoriaTable::class),
                    ];
                    
                    return new Model\PaqueteTuristicoTable($tableGateway, $fk);
                },
                Model\PaqueteTuristicoTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\PaqueteTuristico());
                    return new TableGateway('paquete_turistico', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Pasajero::class => function($container) {
                    $tableGateway = $container->get(Model\PasajeroTable::class);
                    $fk = [
                        'nacionalidad' => $container->get(Model\NacionalidadTable::class),
                        'tipo_documento' => $container->get(Model\TipoDocumentoTable::class),
                        'categoria' => $container->get(Model\CategoriaTable::class),
                    ];
                    
                    return new Model\PasajeroTable($tableGateway, $fk);
                },
                Model\PasajeroTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Pasajero());
                    return new TableGateway('pasajero', $dbAdapter, null, $resultSetPrototype);
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
                Model\Nacionalidad::class => function($container) {
                    $tableGateway = $container->get(Model\NacionalidadTable::class);
                    
                    return new Model\NacionalidadTable($tableGateway);
                },
                Model\NacionalidadTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Nacionalidad());
                    return new TableGateway('nacionalidad', $dbAdapter, null, $resultSetPrototype);
                },
                Model\TipoDocumento::class => function($container) {
                    $tableGateway = $container->get(Model\TipoDocumentoTable::class);
                    
                    return new Model\TipoDocumentoTable($tableGateway);
                },
                Model\TipoDocumentoTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\TipoDocumento());
                    return new TableGateway('tipo_documento', $dbAdapter, null, $resultSetPrototype);
                },
                Model\CtaBancaria::class => function($container) {
                    $tableGateway = $container->get(Model\CtaBancariaTable::class);
                    $fk = array (
                        'banco' => $container->get(Model\BancoTable::class),
                        'moneda' => $container->get(Model\MonedaTable::class)
                    );
                    
                    return new Model\CtaBancariaTable($tableGateway, $fk);
                },
                Model\CtaBancariaTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\CtaBancaria());
                    return new TableGateway('cta_bancaria', $dbAdapter, null, $resultSetPrototype);
                },
                Model\User::class => function($container) {
                    $tableGateway = $container->get(Model\UserTable::class);
                    return new Model\UserTable($tableGateway);
                },
                Model\UserTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Colegio::class => function($container) {
                    $tableGateway = $container->get(Model\ColegioTable::class);
                    return new Model\ColegioTable($tableGateway);
                },
                Model\ColegioTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Colegio());
                    return new TableGateway('colegio', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Moneda::class => function($container) {
                    $tableGateway = $container->get(Model\MonedaTable::class);
                    return new Model\MonedaTable($tableGateway);
                },
                Model\MonedaTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Moneda());
                    return new TableGateway('moneda', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Banco::class => function($container) {
                    $tableGateway = $container->get(Model\BancoTable::class);
                    return new Model\BancoTable($tableGateway);
                },
                Model\BancoTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Banco());
                    return new TableGateway('banco', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Categoria::class => function($container) {
                    $tableGateway = $container->get(Model\CategoriaTable::class);
                    return new Model\CategoriaTable($tableGateway);
                },
                Model\CategoriaTable::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Categoria());
                    return new TableGateway('categoria', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
}
