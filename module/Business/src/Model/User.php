<?php

namespace Business\Model;

/**
 * Description of Usuario
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class User
{
    public $id;
    public $username;
    public $password;
    public $full_name;
    public $email;
    public $role_id;
    public $active;
    
    public function getId()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getFullName()
    {
        return $this->full_name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getRoleId()
    {
        return $this->role_id;
    }
    public function getActive()
    {
        return $this->active;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setFullName($fullName)
    {
        $this->full_name = $fullName;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setRoleId($roleId)
    {
        $this->role_id = $roleId;
    }
    public function setActive($active)
    {
        $this->active = $active;
    }
        
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->full_name = (isset($data['full_name'])) ? $data['full_name'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->role_id = (isset($data['role_id'])) ? $data['role_id'] : null;
        $this->active = (isset($data['active'])) ? $data['active'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}