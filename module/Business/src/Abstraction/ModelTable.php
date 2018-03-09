<?php

namespace Business\Abstraction;


/**
 * Description of Abstraction/ModelTable
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
abstract class ModelTable 
{
    
    public function obtenerFecha($fecha)
    {
        $fechaTmp = explode('-', $fecha);
        $formatDate = $fechaTmp[2] . '/' . $fechaTmp[1] . '/' . $fechaTmp[0];
        
        return $formatDate;
    }
}