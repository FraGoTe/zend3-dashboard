<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;

class PaqueteTuristicoController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'titulo' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'fecha_viaje' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200,
                'DATE' => 1
            ],
            'destino' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'precio_viaje' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'salon_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'documento_adicional' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'cta_bancaria_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'moneda_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'titulo' => 'Titulo',
            'fecha_viaje' => 'Fecha Viaje',
            'destino' => 'Destino',
            'precio_viaje' => 'Precio',
           
            'salon_id' => 'Salón',
            'documento_adicional' => 'Documento Adicional',
            'cta_bancaria_id' => 'Cta Bancaria',
            'moneda_id' => 'Moneda',
        );
        
        $indexRedirect = 'cobranza-paqueteturistico-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'titulo'
        );
        
        $this->setTitulo('Paquete Turístico');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
