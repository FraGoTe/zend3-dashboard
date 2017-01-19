<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class CategoriaController extends ControllerCRUD
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
                'LENGHT' => 100
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'nombre' => 'Descripción',
        );
        
        $indexRedirect = 'cobranza-categoria-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'nombre'
        );
        
        $this->setTitulo('Tipo Pax');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
