<?php

/**
 * Modulo Model
 * @autor Francis Gonzales <fgonzalestello91@gmail.com>
 */

namespace Business\Model;

class Modulo
{
   public $id;
   public $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



   public function exchangeArray($data)
   {
      $this->id = (isset($data['id'])) ? $data['id'] : null;
      $this->name = (isset($data['name'])) ? $data['name'] : null;
   }

   public function getArrayCopy()
   {
      return get_object_vars($this);
   }

}