<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Business;

use Dashboard\Controller as Dcontroller;
use Zend\Router\Http\Literal;

return [
   'router' => [
      'routes' => [
         'dashboard-login' => [
            'type' => Literal::class,
            'options' => [
               'route'    => '/',
               'defaults' => [
                  'controller' => Dcontroller\LoginController::class,
                  'action'     => 'login',
               ],
            ],
         ],
      ],
   ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
