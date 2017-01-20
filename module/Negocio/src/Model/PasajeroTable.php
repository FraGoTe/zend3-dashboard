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