<?php

namespace Negocio\Abstraction;

use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

/**
 * Description of Abstraction/Model
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
abstract class Model {
    
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function getClassName()
    {
        return get_called_class();
    }
    
    public function getPrototypeClass()
    {
        return str_replace('Table', '', $this->getClassName());
    }
    
    public function getTableGateway()
    {
        return $this->tableGateway;
    }
 
    public function fetchAll($paginated = false)
    {
        if ($paginated) {
            return $this->fetchPaginatedResults();
        }

        return $this->tableGateway->select();
    }

    private function fetchPaginatedResults()
    {
        $prototypeClass = $this->getPrototypeClass();
        $select = new Select($this->tableGateway->getTable());

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new $prototypeClass);

        $paginatorAdapter = new DbSelect(
            $select,
            $this->tableGateway->getAdapter(),
            $resultSetPrototype
        );

        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }
}
