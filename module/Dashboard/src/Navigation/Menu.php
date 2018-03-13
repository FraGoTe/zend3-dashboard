<?php

/**
 * Description of DashboardMenu
 *
 * @author fragote
 */
namespace Dashboard\Navigation;

use Business\Model\Privilege;
use Business\Model\PrivilegeTable;
use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Navigation\AbstractContainer;
use Zend\Authentication\AuthenticationService;


class Menu extends AbstractContainer
{
   public function __construct(ContainerInterface $container)
   {
      $this->addPrivilegedPages($container->get(Privilege::class));
      $this->addPage(['label' => '<i class="fa fa-power-off"></i> Logout', 'uri' => '/dashboard/logout']);
   }

   public function addPrivilegedPages(PrivilegeTable $privilege)
   {
      $auth = new AuthenticationService();
      $identity = $auth->getIdentity();
      $dataMenu = $privilege->getMenuByUser($identity->id);
      $dashboardMenu = [];

      foreach ($dataMenu as $menu) {
         if (empty($menu['parent'])) {
            $dashboardMenu[$menu['menu_id']] = [
               'label' => $menu['label'],
               'uri' => $menu['url']
            ];
         } else {
            $dashboardMenu[$menu['parent']]['pages'][$menu['menu_id']] = [
               'label' => $menu['label'],
               'uri' => $menu['url']
            ];
         }
      }

      $this->addPages($dashboardMenu);
   }
}