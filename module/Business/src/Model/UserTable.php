<?php

namespace Business\Model;

use Business\Abstraction\Model;

/**
 * Description of UserTable
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class UserTable extends Model
{
    
    /**
     * This functions returns a query to get 
     * all the users
     * @return \Zend\Db\Sql\Select
     */
    public function getUsersList()
    {
        $select = new Select();
        $select->from(array(
                    'u' => 'user'
                ))
                ->join(array(
                    'r' => 'role'
                    ), 
                    'u.role_id = r.id'
                 )
                ->order('u.id');
        
        return $select;
    }
    
    /**
     * This function returns the user by ID
     * @param int $userId
     * @return array
     */
    public function getUser($userId)
    {
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql
                  ->select()
                  ->from(array('u' => 'user'))
                  ->join(
                        array('r' => 'role'),
                        'r.id = u.role_id',
                        array('*')
                    )
                  ->where(array('u.id' => $userId))
                  ->order('u.id');
        $stmt = $sql->prepareStatementForSqlObject($select);
        $results = $stmt->execute(); 
        return $results;
    }
    
    /**
     * This function allows to add users
     * @param array $params
     * @return boolean
     */
    public function addUser($params)
    {
        $params['password'] = sha1($params['password']);
        $rs = $this->tableGateway->insert($params);
        return $rs;
    }
    
    /**
     * This function allows to edit Users
     * @param array $set
     * @param array $where
     * @return boolean
     */
    public function editUser($set, $where)
    {
        if (!empty($set['password'])) {
            $set['password'] = sha1($set['password']);
        } else {
            unset($set['password']);
        }
        $rs = $this->tableGateway->update($set, $where);
        return $rs;
    }
    
    public function deleteUser($userId)
    {
        $where = array('id' => $userId);
        $rs = $this->tableGateway->delete($where);
        return $rs;
    }

    public function obtenerRoles()
    {
        $arrRol = [];
        $roles = $this->fkTable['rol']->select()->toArray();
        foreach ($roles as $rol) {
            $arrRol[$rol['id']] = $rol['name'];
        }
        return $arrRol;
    }
}