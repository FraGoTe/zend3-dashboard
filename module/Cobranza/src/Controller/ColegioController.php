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
    protected $describeColumnas = array(
        'id' => [
            'PK' => 1,
            'AI' => 1
        ],
        'nombre' => [
            'PK' => 0,
            'AI' => 0,
            'TIPO' => 'VARCHAR',
            'LENGHT' => 45
        ],
        'direccion' => [
            'PK' => 0,
            'AI' => 0,
            'TIPO' => 'VARCHAR',
            'LENGHT' => 45
        ],
        'pagina_web' => [
            'PK' => 0,
            'AI' => 0,
            'TIPO' => 'VARCHAR',
            'LENGHT' => 45
        ],
        'telefono' => [
            'PK' => 0,
            'AI' => 0,
            'TIPO' => 'VARCHAR',
            'LENGHT' => 45
        ],
        'telefono_2' => [
            'PK' => 0,
            'AI' => 0,
            'TIPO' => 'VARCHAR',
            'LENGHT' => 45
        ],
        'contacto' => [
            'PK' => 0,
            'AI' => 0,
            'TIPO' => 'VARCHAR',
            'LENGHT' => 45
        ],
        'telefono_contacto' => [
            'PK' => 0,
            'AI' => 0,
            'TIPO' => 'VARCHAR',
            'LENGHT' => 45
        ]
    );

}
