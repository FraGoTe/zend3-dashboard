<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Dashboard;

use Business\Model;
use Zend\Db\Adapter\Adapter;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\RolController::class => function($container) {
                    return new Controller\RolController(
                        $container->get(Model\Rol::class)
                    );
                },
                Controller\LoginController::class => function($container) {
                   return new Controller\LoginController(
                      $container->get(Adapter::class)
                   );
                },
                Controller\IndexController::class => function($container) {
                   return new Controller\IndexController(
                      $container->get(Adapter::class)
                   );
                },
            ],
        ];
    }
}
