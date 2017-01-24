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
    public $nivel;
    public $grado;
    public $seccion;
    public $descripcion;
    public $colegio_id;

    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nivel = (isset($data['nivel'])) ? $data['nivel'] : null;
        $this->grado = (isset($data['grado'])) ? $data['grado'] : null;
        $this->seccion = (isset($data['seccion'])) ? $data['seccion'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
        $this->colegio_id = (isset($data['colegio_id'])) ? $data['colegio_id'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}