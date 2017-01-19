<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class NacionalidadController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'descripcion' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 100
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'descripcion' => 'Descripción',
        );
        
        $indexRedirect = 'cobranza-nacionalidad-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'descripcion'
        );
        
        $this->setTitulo('Nacionalidad');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
