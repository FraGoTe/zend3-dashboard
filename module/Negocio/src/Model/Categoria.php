<?php

namespace Negocio\Model;

/**
 * Description of Categoria
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class Categoria
{
    public $id;
    public $nombre;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}