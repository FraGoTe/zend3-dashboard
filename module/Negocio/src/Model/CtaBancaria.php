<?php

namespace Negocio\Model;

/**
 * Description of CtaBancaria
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
class CtaBancaria
{
    public $id;
    public $nro_cta;
    public $banco_id;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nro_cta = (isset($data['nro_cta'])) ? $data['nro_cta'] : null;
        $this->banco_id = (isset($data['banco_id'])) ? $data['banco_id'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}