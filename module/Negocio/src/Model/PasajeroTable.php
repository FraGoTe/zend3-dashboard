<?php

namespace Negocio\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Negocio\Abstraction\Model;

/**
 * Description of PasajeroTable
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class PasajeroTable extends Model
{
    public function insertData($data)
    {
        if (!empty($data['fecha_nacimiento'])) {
            $data['fecha_nacimiento'] = new \Zend\Db\Sql\Expression("str_to_date('" . $data['fecha_nacimiento'] . "', '%d/%m/%Y')");
        }
        
        try {
            $rs = $this->tableGateway->insert($data);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $rs = false;
        }
        
        return [
            'result' => $rs
        ];
    }
    
    public function getNacionalidad()
    {
        $dataNacionalidad = $this->fkTable['nacionalidad']->select()->toArray();

        $nacionalidad = [];
        foreach ($dataNacionalidad as $nacionalidadTmp) {
            $nacionalidad[$nacionalidadTmp['id']] = $nacionalidadTmp['descripcion'];
        }
        
        return $nacionalidad;
    }
   
    public function getTipoDocumento()
    {
        $dataTipoDocumento = $this->fkTable['tipo_documento']->select()->toArray();

        $tipoDocumento = [];
        foreach ($dataTipoDocumento as $dataTipoDocumentoTmp) {
            $tipoDocumento[$dataTipoDocumentoTmp['id']] = $dataTipoDocumentoTmp['abreviacion'] . ' | ' . $dataTipoDocumentoTmp['descripcion'];
        }

        return $tipoDocumento;
    }
}