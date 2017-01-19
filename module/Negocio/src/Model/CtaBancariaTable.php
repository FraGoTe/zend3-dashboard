<?php

namespace Negocio\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Negocio\Abstraction\Model;

/**
 * Description of CtaBancariaTable
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class CtaBancariaTable extends Model
{
    public function getBanco()
    {
        $dataBanco = $this->fkTable['banco']->select()->toArray();

        $banco = [];
        foreach ($dataBanco as $bancoTmp) {
            $banco[$bancoTmp['id']] = $bancoTmp['descripcion'];
        }
        
        return $banco;
    }
}