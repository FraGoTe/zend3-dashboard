<?php

/**
 * Privilege Table
 * @autor Francis Gonzales <fgonzalestello91@gmail.com>
 */

namespace Business\Model;

use Zend\Db\Sql\Sql;
use Business\Abstraction\Model;

class PrivilegeTable  extends Model
{
   public function getMenuByUser($userId)
   {
      $sql = new Sql($this->tableGateway->getAdapter());
      $select = $sql
         ->select()
         ->from(array('p' => 'privilege'))
         ->join(
            array('m' => 'menu'),
            'm.id = p.menu_id',
            array('*')
         )
         ->join(
            array('r' => 'role'),
            'r.id = p.role_id',
            array('*')
         )
         ->join(
            array('u' => 'user'),
            'u.role_id = r.id',
            array('full_name')
         )
         ->where(array('u.id' => $userId))
         ->order('m.id');
      $stmt = $sql->prepareStatementForSqlObject($select);

      $results = $stmt ->execute();

      return $results;
   }

    public function obtenerMenu()
    {
        $arrMenu = [];
        $menus = $this->fkTable['menu']->select()->toArray();
        foreach ($menus as $menu) {
            $arrMenu[$menu['id']] = $menu['url'];
        }
        return $arrMenu;
    }
}