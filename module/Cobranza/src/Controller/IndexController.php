<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cobranza\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public $colegio;


    public function __construct($colegio)
    {
        $this->colegio = $colegio;
    }
    
    public function indexAction()
    {
        $datosColegio = $this->colegio->fetchAll();
        
        return new ViewModel(['colegio' => $datosColegio]);
    }
}
