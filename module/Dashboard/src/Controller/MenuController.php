<?php

namespace Dashboard\Controller;

use Business\Abstraction\ControllerCRUD;

class MenuController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'url' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 100
            ],
            'label' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 150
            ],
            'parent' => [
                'PK' => 0,
                'AI' => 0
            ],
            'module_id' => [
                'PK' => 1,
                'AI' => 0
            ],
        );
            
        $columnasListar = [
            'id' => 'ID',
            'url' => 'Descripción',
            'label' => 'nose',
            'parent' => 'nose tmb',
            'module_id' => 'menos',
        ];
        
        $indexRedirect = 'dashboard-menu-listar';
        
        $tableId = ['id'];
        
        $dscEliminar = [
            'id', 'url','label','parent','module_id'
        ];
        
        $this->setTitulo('Menú');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
