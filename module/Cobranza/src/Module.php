<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cobranza;

use Negocio\Model;
use Zend\Db\Adapter\Adapter;

class Module
{
    const VERSION = '3.0.2dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\NivelController::class => function($container) {
                    return new Controller\NivelController(
                        $container->get(Model\Nivel::class)
                    );
                },
                Controller\GradoController::class => function($container) {
                    return new Controller\GradoController(
                        $container->get(Model\Grado::class)
                    );
                },
                Controller\SeccionController::class => function($container) {
                    return new Controller\SeccionController(
                        $container->get(Model\Seccion::class)
                    );
                },
                Controller\SalonController::class => function($container) {
                    return new Controller\SalonController(
                        $container->get(Model\Salon::class)
                    );
                },
                Controller\TipoViajeController::class => function($container) {
                    return new Controller\TipoViajeController(
                        $container->get(Model\TipoViaje::class)
                    );
                },
                Controller\PaqueteTuristicoController::class => function($container) {
                    return new Controller\PaqueteTuristicoController(
                        $container->get(Model\PaqueteTuristico::class)
                    );
                },
                Controller\PasajeroController::class => function($container) {
                    return new Controller\PasajeroController(
                        $container->get(Model\Pasajero::class)
                    );
                },
                Controller\RolController::class => function($container) {
                    return new Controller\RolController(
                        $container->get(Model\Rol::class)
                    );
                },
                Controller\NacionalidadController::class => function($container) {
                    return new Controller\NacionalidadController(
                        $container->get(Model\Nacionalidad::class)
                    );
                },
                Controller\TipoDocumentoController::class => function($container) {
                    return new Controller\TipoDocumentoController(
                        $container->get(Model\TipoDocumento::class)
                    );
                },
                Controller\CtaBancariaController::class => function($container) {
                    return new Controller\CtaBancariaController(
                        $container->get(Model\CtaBancaria::class)
                    );
                },
                Controller\CategoriaController::class => function($container) {
                    return new Controller\CategoriaController(
                        $container->get(Model\Categoria::class)
                    );
                },
                Controller\BancoController::class => function($container) {
                    return new Controller\BancoController(
                        $container->get(Model\Banco::class)
                    );
                },
                Controller\MonedaController::class => function($container) {
                    return new Controller\MonedaController(
                        $container->get(Model\Moneda::class)
                    );
                },
                Controller\ColegioController::class => function($container) {
                    return new Controller\ColegioController(
                        $container->get(Model\Colegio::class)
                    );
                },
                Controller\LoginController::class => function($container) {
                    return new Controller\LoginController(
                        $container->get(Adapter::class)
                    );
                },
                Controller\IndexController::class => function($container) {
                    return new Controller\IndexController(
                        $container->get(Model\Colegio::class)
                    );
                },
            ],
        ];
    }
}
