<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class TipoDocumentoController extends ControllerCRUD
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
            'abreviacion' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'descripcion' => 'Descripción',
            'abreviacion' => 'Abreviación',
        );
        
        $indexRedirect = 'cobranza-tipodocumento-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'abreviacion', 'descripcion'
        );
        
        $this->setTitulo('Documento de Identidad');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
