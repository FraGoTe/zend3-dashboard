<?php

/**
 * Privilege Model
 * @autor Francis Gonzales <fgonzalestello91@gmail.com>
 */

namespace Business\Model;

class Privilege
{
   public $id;
   public $role_id;
   public $menu_id;

   public function getId()
   {
      return $this->id;
   }

   public function getRoleId()
   {
      return $this->role_id;
   }

   public function getMenuId()
   {
      return $this->menu_id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function setRoleId($roleId)
   {
      $this->role_id = $roleId;
   }

   public function setMenuId($menuId)
   {
      $this->menu_id = $menuId;
   }


   public function exchangeArray($data)
   {
      $this->id = (isset($data['id'])) ? $data['id'] : null;
      $this->role_id = (isset($data['role_id'])) ? $data['role_id'] : null;
      $this->menu_id = (isset($data['menu_id'])) ? $data['menu_id'] : null;
   }

   public function getArrayCopy()
   {
      return get_object_vars($this);
   }
}