<?php

namespace Negocio\Model;

/**
 * Description of TipoDocumento
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class TipoDocumento
{
    public $id;
    public $descripcion;
    public $abreviacion;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
        $this->abreviacion = (isset($data['abreviacion'])) ? $data['abreviacion'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}