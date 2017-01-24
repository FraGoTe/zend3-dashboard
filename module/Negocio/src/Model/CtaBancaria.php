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
    public $moneda_id;
    public $titular;
    public $cci;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nro_cta = (isset($data['nro_cta'])) ? $data['nro_cta'] : null;
        $this->banco_id = (isset($data['banco_id'])) ? $data['banco_id'] : null;
        $this->moneda_id = (isset($data['moneda_id'])) ? $data['moneda_id'] : null;
        $this->titular = (isset($data['titular'])) ? $data['titular'] : null;
        $this->cci = (isset($data['cci'])) ? $data['cci'] : null;
    }
 
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}