<?php

namespace Negocio\Model;

/**
 * Description of Salon
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class Salon
{
    public $id;
    public $nivel_id;
    public $grado_id;
    public $seccion_id;
    public $descripcion;
    public $colegio_id;

    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nivel_id = (isset($data['nivel_id'])) ? $data['nivel_id'] : null;
        $this->grado_id = (isset($data['grado_id'])) ? $data['grado_id'] : null;
        $this->seccion_id = (isset($data['seccion_id'])) ? $data['seccion_id'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
        $this->colegio_id = (isset($data['colegio_id'])) ? $data['colegio_id'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}