<?php

namespace Negocio\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Negocio\Abstraction\Model;

/**
 * Description of SalonTable
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class SalonTable extends Model
{
    public function getNivel()
    {
        $dataAll = $this->fkTable['nivel']->select()->toArray();
        $dataRtn = [];
        foreach ($dataAll as $dataTmp) {
            $dataRtn[$dataTmp['id']] = $dataTmp['descripcion'];
        }
        
        return $dataRtn;
    }
    
    public function getGrado()
    {
        $dataAll = $this->fkTable['grado']->select()->toArray();

        $dataRtn = [];
        foreach ($dataAll as $dataTmp) {
            $dataRtn[$dataTmp['id']] = $dataTmp['descripcion'];
        }
        
        return $dataRtn;
    }
    
    public function getSeccion()
    {
        $dataAll = $this->fkTable['seccion']->select()->toArray();

        $dataRtn = [];
        foreach ($dataAll as $dataTmp) {
            $dataRtn[$dataTmp['id']] = $dataTmp['descripcion'];
        }
        
        return $dataRtn;
    }
    
    public function getColegio()
    {
        $dataColegio = $this->fkTable['colegio']->select()->toArray();

        $colegio = [];
        foreach ($dataColegio as $colegioTmp) {
            $colegio[$colegioTmp['id']] = $colegioTmp['nombre'];
        }
        
        return $colegio;
    }
}