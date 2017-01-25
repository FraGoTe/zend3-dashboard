<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class SalonController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'nivel_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5,
                'FK' => 1,
                'FUNC' => 'getNivel',
            ],
            'grado_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5,
                'FK' => 1,
                'FUNC' => 'getGrado',
            ],
            'seccion_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5,
                'FK' => 1,
                'FUNC' => 'getSeccion',
            ],
            'descripcion' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 100
            ],
            'colegio_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5,
                'FK' => 1,
                'FUNC' => 'getColegio',
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'nivel_id' => 'Nivel',
            'grado_id' => 'Grado',
            'seccion_id' => 'Sección',
            'descripcion' => 'Descripción',
            'colegio_id' => 'Colegio',

        );
        
        $indexRedirect = 'cobranza-salon-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'descripcion'
        );
        
        $this->setTitulo('Salón');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }
}
