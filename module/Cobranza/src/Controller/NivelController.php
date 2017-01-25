<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class NivelController extends ControllerCRUD
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
                'LENGHT' => 45
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'descripcion' => 'Descripción',
        );
        
        $indexRedirect = 'cobranza-nivel-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'descripcion'
        );
        
        $this->setTitulo('Nivel');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
