<?php

namespace Business\Model;


use Zend\Db\Sql\Sql;
use Business\Abstraction\Model;
/**
 * Description of UserTable
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class MenuTable extends Model
{
    public function obtenerModulo()
    {
        $arrModulo = [];
        $modulos = $this->fkTable['modulo']->select()->toArray();
        foreach ($modulos as $modulo) {
            $arrModulo[$modulo['id']] = $modulo['name'];
        }
        return $arrModulo;
    }
}