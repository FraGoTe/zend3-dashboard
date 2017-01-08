<?php

namespace Negocio\Model;

/**
 * Description of Colegio
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class Colegio
{
    public $id;
    public $nombre;
    public $direccion;
    public $pagina_web;
    public $telefono;
    public $telefono_2;
    public $contacto;
    public $telefono_contacto;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->direccion = (isset($data['direccion'])) ? $data['direccion'] : null;
        $this->pagina_web = (isset($data['pagina_web'])) ? $data['pagina_web'] : null;
        $this->telefono = (isset($data['telefono'])) ? $data['telefono'] : null;
        $this->telefono_2 = (isset($data['telefono_2'])) ? $data['telefono_2'] : null;
        $this->contacto = (isset($data['contacto'])) ? $data['contacto'] : null;
        $this->telefono_contacto = (isset($data['telefono_contacto'])) ? $data['telefono_contacto'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}