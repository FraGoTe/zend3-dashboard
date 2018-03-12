<?php

namespace Dashboard\Navigation;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MenuFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $navigation =  new MyNavigation();
        return $navigation->createService($serviceLocator);
    }
}