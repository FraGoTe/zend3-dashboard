<?php

namespace Negocio\Model;

/**
 * Description of Pasajero
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class Pasajero
{
    public $id;
    public $tipo_documento_id;
    public $numero_documento;
    public $nombre;
    public $apellidos;
    public $correo;
    public $telefono;
    public $celular;
    public $direccion;
    public $fecha_nacimiento;
    public $nacionalidad_id;

    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->tipo_documento_id = (isset($data['tipo_documento_id'])) ? $data['tipo_documento_id'] : null;
        $this->numero_documento = (isset($data['numero_documento'])) ? $data['numero_documento'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->apellidos = (isset($data['apellidos'])) ? $data['apellidos'] : null;
        $this->correo = (isset($data['correo'])) ? $data['correo'] : null;
        $this->telefono = (isset($data['telefono'])) ? $data['telefono'] : null;
        $this->celular = (isset($data['celular'])) ? $data['celular'] : null;
        $this->direccion = (isset($data['direccion'])) ? $data['direccion'] : null;
        $this->fecha_nacimiento = (isset($data['fecha_nacimiento'])) ? $data['fecha_nacimiento'] : null;
        $this->nacionalidad_id = (isset($data['nacionalidad_id'])) ? $data['nacionalidad_id'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}