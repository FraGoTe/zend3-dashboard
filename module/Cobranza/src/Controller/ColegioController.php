<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class ColegioController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'nombre' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ],
            'direccion' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'pagina_web' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ],
            'telefono' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ],
            'telefono_2' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ],
            'contacto' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ],
            'telefono_contacto' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ]
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'nombre' => 'Descripción',
            'direccion' => 'Dirección',
            'pagina_web' => 'Website',
            'telefono' => 'Teléfono',
            'telefono_2' => 'Teléfono Adc.',
            'contacto' => 'Contacto',
            'telefono_contacto' => 'Telf. Contacto'
        );
        
        $indexRedirect = 'cobranza-colegio-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'nombre'
        );
        
        $this->setTitulo('Colegios');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
