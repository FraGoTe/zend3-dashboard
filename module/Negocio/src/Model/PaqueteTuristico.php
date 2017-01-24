<?php

namespace Negocio\Model;

/**
 * Description of PaqueteTuristico
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class PaqueteTuristico
{
    public $id;
    public $titulo;
    public $fecha_viaje;
    public $destino;
    public $precio_viaje;
    public $salon_id;
    public $documento_adicional;
    public $cta_bancaria_id;
    public $moneda_id;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->titulo = (isset($data['titulo'])) ? $data['titulo'] : null;
        $this->fecha_viaje = (isset($data['fecha_viaje'])) ? $data['fecha_viaje'] : null;
        $this->destino = (isset($data['destino'])) ? $data['destino'] : null;
        $this->precio_viaje = (isset($data['precio_viaje'])) ? $data['precio_viaje'] : null;
        $this->salon_id = (isset($data['salon_id'])) ? $data['salon_id'] : null;
        $this->documento_adicional = (isset($data['documento_adicional'])) ? $data['documento_adicional'] : null;
        $this->cta_bancaria_id = (isset($data['cta_bancaria_id'])) ? $data['cta_bancaria_id'] : null;
        $this->moneda_id = (isset($data['moneda_id'])) ? $data['moneda_id'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}