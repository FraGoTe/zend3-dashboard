<?php

namespace Negocio\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Negocio\Abstraction\Model;

/**
 * Description of PaqueteTuristicoTable
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class PaqueteTuristicoTable extends Model
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
    
    public function getSalon()
    {
        $dataSalon = $this->fkTable['salon']->select()->toArray();

        $salon = [];
        foreach ($dataSalon as $dataTmp) {
            $salon[$dataTmp['colegio_id']][$dataTmp['id']] = $dataTmp['descripcion'];
        }
        
        return $salon;
    }
    
    public function getMoneda()
    {
        $dataMoneda = $this->fkTable['moneda']->select()->toArray();

        $moneda = [];
        foreach ($dataMoneda as $monedaTmp) {
            $moneda[$monedaTmp['id']] = $monedaTmp['simbolo'] . ' | ' . $monedaTmp['descripcion'];
        }
        
        return $moneda;
    }
    
    public function getCtaBancaria()
    {
        $dataCta = $this->fkTable['cta_bancaria']->select()->toArray();

        $ctaBancaria = [];
        foreach ($dataCta as $ctaBancariaTmp) {
            $ctaBancaria[$ctaBancariaTmp['moneda_id']][$ctaBancariaTmp['id']] = $ctaBancariaTmp['nro_cta'] . ' | ' . $ctaBancariaTmp['titular'];
        }
        
        return $ctaBancaria;
    }
}