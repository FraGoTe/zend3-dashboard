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
            'cobranza-index' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza',
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
            'cobranza-logout' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/logout',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'logout',
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
                    'route'    => '/cobranza/colegio/editar/id/:id',
                    'defaults' => [
                        'controller' => Controller\ColegioController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-colegio-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/colegio/eliminar/id/:id',
                    'defaults' => [
                        'controller' => Controller\ColegioController::class,
                        'action'     => 'eliminar',
                    ],
                ],
            ],
            'cobranza-moneda' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/moneda',
                    'defaults' => [
                        'controller' => Controller\MonedaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-moneda-listar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/moneda/listar',
                    'defaults' => [
                        'controller' => Controller\MonedaController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
            'cobranza-moneda-agregar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/moneda/agregar',
                    'defaults' => [
                        'controller' => Controller\MonedaController::class,
                        'action'     => 'agregar',
                    ],
                ],
            ],
            'cobranza-moneda-editar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/moneda/editar/id/:id',
                    'defaults' => [
                        'controller' => Controller\MonedaController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-moneda-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/moneda/eliminar/id/:id',
                    'defaults' => [
                        'controller' => Controller\MonedaController::class,
                        'action'     => 'eliminar',
                    ],
                ],
            ],
            'cobranza-banco' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/banco',
                    'defaults' => [
                        'controller' => Controller\BancoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-banco-listar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/banco/listar',
                    'defaults' => [
                        'controller' => Controller\BancoController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
            'cobranza-banco-agregar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/banco/agregar',
                    'defaults' => [
                        'controller' => Controller\BancoController::class,
                        'action'     => 'agregar',
                    ],
                ],
            ],
            'cobranza-banco-editar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/banco/editar/id/:id',
                    'defaults' => [
                        'controller' => Controller\BancoController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-banco-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/banco/eliminar/id/:id',
                    'defaults' => [
                        'controller' => Controller\BancoController::class,
                        'action'     => 'eliminar',
                    ],
                ],
            ],
            'cobranza-categoria' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-pax',
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-categoria-listar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-pax/listar',
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
            'cobranza-categoria-agregar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-pax/agregar',
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'agregar',
                    ],
                ],
            ],
            'cobranza-categoria-editar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-pax/editar/id/:id',
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-categoria-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-pax/eliminar/id/:id',
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'eliminar',
                    ],
                ],
            ],
            'cobranza-ctabancaria' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/cta-bancaria',
                    'defaults' => [
                        'controller' => Controller\CtaBancariaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-ctabancaria-listar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/cta-bancaria/listar',
                    'defaults' => [
                        'controller' => Controller\CtaBancariaController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
            'cobranza-ctabancaria-agregar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/cta-bancaria/agregar',
                    'defaults' => [
                        'controller' => Controller\CtaBancariaController::class,
                        'action'     => 'agregar',
                    ],
                ],
            ],
            'cobranza-ctabancaria-editar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/cta-bancaria/editar/id/:id',
                    'defaults' => [
                        'controller' => Controller\CtaBancariaController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-ctabancaria-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/cta-bancaria/eliminar/id/:id',
                    'defaults' => [
                        'controller' => Controller\CtaBancariaController::class,
                        'action'     => 'eliminar',
                    ],
                ],
            ],
            'cobranza-tipodocumento' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-documento',
                    'defaults' => [
                        'controller' => Controller\TipoDocumentoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-tipodocumento-listar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-documento/listar',
                    'defaults' => [
                        'controller' => Controller\TipoDocumentoController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
            'cobranza-tipodocumento-agregar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-documento/agregar',
                    'defaults' => [
                        'controller' => Controller\TipoDocumentoController::class,
                        'action'     => 'agregar',
                    ],
                ],
            ],
            'cobranza-tipodocumento-editar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-documento/editar/id/:id',
                    'defaults' => [
                        'controller' => Controller\TipoDocumentoController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-tipodocumento-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/tipo-documento/eliminar/id/:id',
                    'defaults' => [
                        'controller' => Controller\TipoDocumentoController::class,
                        'action'     => 'eliminar',
                    ],
                ],
            ],
            'cobranza-pasajero' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/pasajero',
                    'defaults' => [
                        'controller' => Controller\PasajeroController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cobranza-pasajero-listar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/pasajero/listar',
                    'defaults' => [
                        'controller' => Controller\PasajeroController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
            'cobranza-pasajero-agregar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/pasajero/agregar',
                    'defaults' => [
                        'controller' => Controller\PasajeroController::class,
                        'action'     => 'agregar',
                    ],
                ],
            ],
            'cobranza-pasajero-editar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/pasajero/editar/id/:id',
                    'defaults' => [
                        'controller' => Controller\PasajeroController::class,
                        'action'     => 'editar',
                    ],
                ],
            ],
            'cobranza-pasajero-eliminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cobranza/pasajero/eliminar/id/:id',
                    'defaults' => [
                        'controller' => Controller\PasajeroController::class,
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
