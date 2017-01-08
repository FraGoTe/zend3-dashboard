<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class ColegioController extends ControllerCRUD
{
    protected $indexRedirect = 'cobranza-colegio-listar';
    protected $titulo = 'Colegios';
    protected $columnasListar = array(
        'id' => 'ID',
        'nombre' => 'Descripción',
        'direccion' => 'Dirección',
        'pagina_web' => 'Website',
        'telefono' => 'Teléfono',
        'telefono_2' => 'Teléfono Adc.',
        'contacto' => 'Contacto',
        'telefono_contacto' => 'Telf. Contacto'
    );

}
