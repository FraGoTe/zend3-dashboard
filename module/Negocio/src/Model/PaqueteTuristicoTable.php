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
    public function obtenerRegistros()
    {
        $select = new Select($this->tableGateway->getTable());
        $select->columns(['id', 'titulo', 'fecha_viaje', 'destino', 'precio_viaje', 'documento_adicional'])
               ->join(array('s' => 'salon'), 's.id = paquete_turistico.salon_id', array('salon_id' => 'descripcion'))
               ->join(array('c' => 'colegio'), 's.colegio_id = c.id', array('colegio_id' => 'nombre'))
               ->join(array('t' => 'tipo_viaje'), 'paquete_turistico.tipo_viaje_id = t.id', array('tipo_viaje_id' => 'descripcion'))
               ->join(array('cta' => 'cta_bancaria'), 'paquete_turistico.cta_bancaria_id = cta.id', array('cta_bancaria_id' => new \Zend\Db\Sql\Expression('CONCAT(cta.nro_cta, \' | \', cta.titular)')));

        return $select;
    }
    
    public function fetchAll($paginated = false)
    {
        if ($paginated) {
            return $this->fetchPaginatedResults();
        }

        return $this->obtenerRegistros();
    }

    private function fetchPaginatedResults()
    {
        $prototypeClass = $this->getPrototypeClass();
        
        $select = $this->obtenerRegistros();

        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new $prototypeClass);

        $paginatorAdapter = new \Zend\Paginator\Adapter\DbSelect(
            $select,
            $this->tableGateway->getAdapter(),
            $resultSetPrototype
        );

        $paginator = new \Zend\Paginator\Paginator($paginatorAdapter);
        
        return $paginator;
    }
    
    public function insertData($data)
    {
        if (!empty($data['fecha_viaje'])) {
            $data['fecha_viaje'] = new \Zend\Db\Sql\Expression("str_to_date('" . $data['fecha_viaje'] . "', '%d/%m/%Y')");
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
    
    public function getTipoViaje()
    {
        $dataTipoViaje = $this->fkTable['tipo_viaje']->select()->toArray();

        $tipoViaje = [];
        foreach ($dataTipoViaje as $tipoTmp) {
            $tipoViaje[$tipoTmp['id']] = $tipoTmp['descripcion'];
        }
        
        return $tipoViaje;
    }
}