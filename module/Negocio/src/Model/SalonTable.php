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