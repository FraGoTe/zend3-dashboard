<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class PasajeroController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'tipo_documento_id' => [
                'PK' => 0,
                'AI' => 0,
                'FK' => 1,
                'FUNC' => 'getTipoDocumento',
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1
            ],
            'numero_documento' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 12
            ],
            'nombre' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ],
            'apellidos' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'correo' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 100
            ],
            'telefono' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 45
            ],
            'celular' => [
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
                'LENGHT' => 12
            ],
            'fecha' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 10
            ],
            'nacionalidad_id' => [
                'PK' => 0,
                'AI' => 0,
                'FK' => 1,
                'FUNC' => 'getNacionalidad',
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
        );
        
        $indexRedirect = 'cobranza-pasajero-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'nombre', 'apellidos'
        );
        
        $this->setTitulo('Documento de Identidad');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
