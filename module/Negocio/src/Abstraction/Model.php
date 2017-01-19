<?php

namespace Negocio\Abstraction;

use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\InputFilter\InputFilter;
use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

/**
 * Description of Abstraction/Model
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
abstract class Model {
    
    protected $tableGateway;
    protected $fkTable;
    
    public function __construct(TableGateway $tableGateway, $fkTable = array())
    {
        $this->tableGateway = $tableGateway;
        $this->fkTable = $fkTable;
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
    
    public function getData($dataKey)
    {
        try {
            $dataRow = $this->tableGateway->select($dataKey);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $rs = false;
        }
       
        return [
            'data' => $dataRow
        ];
    }
    
    public function insertData($data)
    {
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
    
    public function updateData($updateKeys, $setData)
    {
        try {
            $rs = $this->tableGateway->update($setData, $updateKeys);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $rs = false;
        }

        
        return [
            'result' => $rs
        ];
    }
    
    public function deleteData($keyInfo)
    {
        try {
            $rs = $this->tableGateway->delete($keyInfo);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $rs = false;
        }

        return $rs;
    }
    
    public function getInputFilter($fields)
    {
        if (empty($fields)) {
            return [];
        }

        $inputFilter = new InputFilter();

        foreach ($fields as $name => $field) {
            if (empty($field['AI']) && empty($field['FK'])) {
                $inputFilter->add([
                    'name' => $name,
                    'required' => $field['REQUIRED'],
                    'filters' => [
                        ['name' => StripTags::class],
                        ['name' => StringTrim::class],
                    ],
                    'validators' => [
                        [
                            'name' => StringLength::class,
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min' => $field['MIN_LENGHT'],
                                'max' => $field['LENGHT'],
                            ],
                        ],
                    ],
                ]);
            }
            
            if (!empty($field['FK'])) {
                $inputFilter->add([
                    'name' => $name,
                    'required' => $field['REQUIRED'],
                    'filters' => [
                        ['name' => StripTags::class],
                        ['name' => StringTrim::class],
                    ],
                    'validators' => [
                        [
                            'name' => StringLength::class,
                            'options' => [
                                'encoding' => 'UTF-8',
                            ],
                        ],
                    ],
                ]);
            }
        }


        return $inputFilter;
    }
}
