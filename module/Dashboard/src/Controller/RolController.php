<?php

namespace Dashboard\Controller;

use Business\Abstraction\ControllerCRUD;

class RolController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'name' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 100
            ],
        );
            
        $columnasListar = [
            'id' => 'ID',
            'name' => 'Descripción',
        ];
        
        $indexRedirect = 'dashboard-rol-listar';
        
        $tableId = ['id'];
        
        $dscEliminar = [
            'id', 'name'
        ];
        
        $this->setTitulo('Roles');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
