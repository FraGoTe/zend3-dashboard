<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class CtaBancariaController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'nro_cta' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 100
            ],
            'banco_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'INT',
                'REQUIRED' => true,
                'FK' => 1,
                'FUNC' => 'getBanco'
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'nro_cta' => 'Nro. Cuenta',
            'banco_id' => 'Banco'
        );
        
        $indexRedirect = 'cobranza-ctabancaria-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'nro_cta', 'banco_id'
        );
        
        $this->setTitulo('Cuenta Bancaria');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
