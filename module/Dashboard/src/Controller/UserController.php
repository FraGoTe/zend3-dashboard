<?php

namespace Dashboard\Controller;

use Business\Abstraction\ControllerCRUD;

class UserController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'username' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 40
            ],
            'password' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 40
            ],
            'full_name' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 300
            ],
            'email' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 300
            ],
            'active' => [
                'PK' => 0,
                'AI' => 0
            ],
            'role_id' => [
                'PK' => 1,
                'AI' => 0
            ],
        );
            
        $columnasListar = [
            'id' => 'ID',
            'username' => 'Descripción',
            'full_name' =>'Nombre completo',
            'email' =>'Correo',
            'password' => 'Contraseña',
            'role_id' =>'Rol',
            'active' => 'Active'
        ];
        
        $indexRedirect = 'dashboard-user-listar';
        
        $tableId = ['id'];
        
        $dscEliminar = [
            'id', 'username','full_name','email','role_id','active'
        ];
        
        $this->setTitulo('Usuarios');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
    }

}
