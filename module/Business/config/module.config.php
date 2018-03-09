<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Business;

use Dashboard\Controller as Dcontroller;
use Zend\Router\Http\Literal;

$routes = [
   'dashboard-login' => [
      'route' => '/',
      'controller' => Dcontroller\LoginController::class,
      'action'     => 'index',
   ],
   'dashboard-logout' => [
      'route' => '/dashboard/logout',
      'controller' => Dcontroller\LoginController::class,
      'action'     => 'logout',
   ],
   'dashboard-index' => [
      'route' => '/dashboard',
      'controller' => Dcontroller\IndexController::class,
      'action'     => 'index',
   ],
   'dashboard-rol-listar' => [
      'route' => '/dashboard/mantenimiento/rol',
      'controller' => Dcontroller\RolController::class,
      'action'     => 'listar',
   ],
   'dashboard-rol-agregar' => [
      'route' => '/dashboard/mantenimiento/rol/agregar',
      'controller' => Dcontroller\RolController::class,
      'action'     => 'agregar',
   ],
   'dashboard-rol-editar' => [
      'route' => '/dashboard/mantenimiento/rol/listar',
      'controller' => Dcontroller\RolController::class,
      'action'     => 'editar',
   ],
   'dashboard-rol-eliminar' => [
      'route' => '/dashboard/mantenimiento/rol/eliminar',
      'controller' => Dcontroller\RolController::class,
      'action'     => 'eliminar',
   ],

];
$arrRoutes = [];

foreach ($routes as $key => $route) {
   $arrRoutes[$key] = [
      'type' => Literal::class,
      'options' => [
         'route'    => $route['route'],
         'defaults' => [
            'controller' => $route['controller'],
            'action'     => $route['action'],
         ],
      ],
   ];
}

return [
   'router' => [
      'routes' => $arrRoutes,
   ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
