<?php

namespace Negocio\Model;

/**
 * Description of Moneda
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class Moneda
{
    public $id;
    public $descripcion;
    public $simbolo;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
        $this->simbolo = (isset($data['simbolo'])) ? $data['simbolo'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}