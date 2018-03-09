<?php

namespace Dashboard\Controller;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Db\Adapter\Adapter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\SessionManager;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
   private $mysqlAdp;

   public function __construct(Adapter $mysqlAdp)
   {
      $this->mysqlAdp = $mysqlAdp;
   }

   public function indexAction()
   {
      $this->layout('layout/login');
      $auth = new AuthenticationService();
      $viewmodel = new ViewModel();
      $request = $this->getRequest();
      $message = ''; //Message

      if ($auth->hasIdentity()) {
         return $this->redirect()->toRoute('dashboard-index');
      }

      if ($request->isPost()) {
         $dataForm = $request->getPost();
         if (!empty($dataForm->usuario) && !empty($dataForm->clave)) {
            $authAdapter = new AuthAdapter($this->mysqlAdp, 'user', 'username', 'password', 'sha1(?) AND active = 1');
            $auth->setAdapter($authAdapter);
            $auth->getAdapter()->setIdentity(strtolower($dataForm->usuario))->setCredential(strtolower($dataForm->clave));
            $result = $auth->authenticate();

            switch ($result->getCode()) {
               case Result::SUCCESS:
                  $storage = $auth->getStorage();
                  $userData = $authAdapter->getResultRowObject();
                  $storage->write($userData);
                  return $this->redirect()->toRoute('dashboard-index');
                  break;
               case Result::FAILURE_UNCATEGORIZED:
                  $message = "El usuario ingresado no tiene acceso.";
                  break;
               default :
                  $message = "Usuario y/o clave incorrecto.";
                  break;
            }
         }

         $this->flashMessenger()->addWarningMessage(['Atención', $message]);
      }

      return $viewmodel;
   }

   public function logoutAction()
   {
      $auth = new AuthenticationService();

      if ($auth->hasIdentity()) {
         $auth->clearIdentity();
         $sessionManager = new SessionManager();
         $sessionManager->forgetMe();
      }

      $this->redirect()->toRoute('dashboard-login');
   }
}
