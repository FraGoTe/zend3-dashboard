<?php

/**
 * Privilege Model
 * @autor Francis Gonzales <fgonzalestello91@gmail.com>
 */

namespace Business\Model;

class Menu
{
   public $id;
   public $url;
   public $label;
   public $parent;
   public $module_id;

   public function getId()
   {
      return $this->id;
   }

   public function getUrl()
   {
      return $this->url;
   }

   public function getLabel()
   {
      return $this->label;
   }
    public function getParent()
    {
        return $this->parent;
    }
    public function getModuleID()
    {
        return $this->module_id;
    }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function setUrl($url)
   {
      $this->url = $url;
   }

   public function setLabel($label)
   {
      $this->label = $label;
   }
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    public function setModuleID($module_id)
    {
        $this->module_id = $module_id;
    }


   public function exchangeArray($data)
   {
      $this->id = (isset($data['id'])) ? $data['id'] : null;
      $this->url = (isset($data['url'])) ? $data['url'] : null;
      $this->label = (isset($data['label'])) ? $data['label'] : null;
      $this->parent= (isset($data['parent'])) ? $data['parent'] : null;
      $this->module_id = (isset($data['module_id'])) ? $data['module_id'] : null;
   }

   public function getArrayCopy()
   {
      return get_object_vars($this);
   }
}