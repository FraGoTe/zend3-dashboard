<?php

namespace Negocio\Model;

/**
 * Description of Banco
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class Banco
{
    public $id;
    public $descripcion;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}