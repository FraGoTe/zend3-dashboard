<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Business;

use Dashboard\Controller as Dcontroller;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

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
      'route' => '/dashboard/mantenimiento/rol/editar/id/:id',
      'controller' => Dcontroller\RolController::class,
      'action'     => 'editar',
      'constraints' => [
         'id'     => '[0-9]+',
      ],
   ],
   'dashboard-rol-eliminar' => [
      'route' => '/dashboard/mantenimiento/rol/eliminar/id/:id',
      'controller' => Dcontroller\RolController::class,
      'action'     => 'eliminar',
      'constraints' => [
         'id'     => '[0-9]+',
      ],
   ],
    'dashboard-modulo-listar' => [
        'route' => '/dashboard/mantenimiento/modulo',
        'controller' => Dcontroller\ModuloController::class,
        'action'     => 'listar',
    ],
    'dashboard-modulo-agregar' => [
        'route' => '/dashboard/mantenimiento/modulo/agregar',
        'controller' => Dcontroller\ModuloController::class,
        'action'     => 'agregar',
    ],
    'dashboard-modulo-editar' => [
        'route' => '/dashboard/mantenimiento/modulo/editar/id/:id',
        'controller' => Dcontroller\ModuloController::class,
        'action'     => 'editar',
        'constraints' => [
            'id'     => '[0-9]+',
        ],
    ],
    'dashboard-modulo-eliminar' => [
        'route' => '/dashboard/mantenimiento/modulo/eliminar/id/:id',
        'controller' => Dcontroller\ModuloController::class,
        'action'     => 'eliminar',
        'constraints' => [
            'id'     => '[0-9]+',
        ],
    ],
    'dashboard-user-listar' => [
        'route' => '/dashboard/mantenimiento/user',
        'controller' => Dcontroller\UserController::class,
        'action'     => 'listar',
    ],
    'dashboard-user-agregar' => [
        'route' => '/dashboard/mantenimiento/usuer/agregar',
        'controller' => Dcontroller\UserController::class,
        'action'     => 'agregar',
    ],
    'dashboard-user-editar' => [
        'route' => '/dashboard/mantenimiento/user/editar/id/:id',
        'controller' => Dcontroller\UserController::class,
        'action'     => 'editar',
        'constraints' => [
            'id'     => '[0-9]+',
        ],
    ],
    'dashboard-user-eliminar' => [
        'route' => '/dashboard/mantenimiento/user/eliminar/id/:id',
        'controller' => Dcontroller\UserController::class,
        'action'     => 'eliminar',
        'constraints' => [
            'id'     => '[0-9]+',
        ],
    ],
    'dashboard-menu-listar' => [
        'route' => '/dashboard/mantenimiento/menu',
        'controller' => Dcontroller\MenuController::class,
        'action'     => 'listar',
    ],
    'dashboard-menu-agregar' => [
        'route' => '/dashboard/mantenimiento/menu/agregar',
        'controller' => Dcontroller\MenuController::class,
        'action'     => 'agregar',
    ],
    'dashboard-menu-editar' => [
        'route' => '/dashboard/mantenimiento/menu/editar/id/:id',
        'controller' => Dcontroller\MenuController::class,
        'action'     => 'editar',
        'constraints' => [
            'id'     => '[0-9]+',
        ],
    ],
    'dashboard-menu-eliminar' => [
        'route' => '/dashboard/mantenimiento/menu/eliminar/id/:id',
        'controller' => Dcontroller\menuController::class,
        'action'     => 'eliminar',
        'constraints' => [
            'id'     => '[0-9]+',
        ],
    ],

];
$arrRoutes = [];

foreach ($routes as $key => $route) {
   $arrRoutes[$key] = [
      'type' => Segment::class,
      'options' => [
         'route'    => $route['route'],
         'defaults' => [
            'controller' => $route['controller'],
            'action'     => $route['action'],
         ],
      ],
   ];

   if (!empty($route['constraints'])) {
      $arrRoutes[$key]['options']['constraints'] = $route['constraints'];
   }
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
