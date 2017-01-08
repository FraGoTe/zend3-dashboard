<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cobranza;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
// use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-login' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/login',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-colegio' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/colegio',
                    'defaults' => [
                        'controller' => Controller\ColegioController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-colegio-listar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/colegio/listar',
                    'defaults' => [
                        'controller' => Controller\ColegioController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
            'cobranza-colegio-agregar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/colegio/agregar',
                    'defaults' => [
                        'controller' => Controller\ColegioController::class,
                        'action'     => 'agregar',
                    ],
                ],
            ],
            'cobranza-colegio-editar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/colegio/editar',
                    'defaults' => [
                        'controller' => Controller\ColegioController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-colegio-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/colegio/eliminar',
                    'defaults' => [
                        'controller' => Controller\ColegioController::class,
                        'action'     => 'eliminar',
                    ],
                ],
            ],
        ],
    ],
    /*'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\LoginController::class => InvokableFactory::class,
        ],
    ], */
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
