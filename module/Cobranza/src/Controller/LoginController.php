<?php

namespace Cobranza\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Negocio\Model\UserTable;
use Zend\Session\SessionManager;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;


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
            return $this->redirect()->toRoute('cobranza-index');
        }
        
        if ($request->isPost()) {
            $dataForm = $request->getPost();
            if (!empty($dataForm->usuario) && !empty($dataForm->clave)) {
                $authAdapter = new AuthAdapter($this->mysqlAdp, 'user', 'username', 'password', 'sha1(?) AND active = 1');
              
                    $auth->setAdapter($authAdapter);

                    $auth->getAdapter()
                            ->setIdentity(strtoupper($dataForm->usuario))
                            ->setCredential(strtoupper($dataForm->clave));
                    $result = $auth->authenticate();

                switch ($result->getCode()) {
                    case Result::SUCCESS:
                        $storage = $auth->getStorage();
                        $userData = $authAdapter->getResultRowObject();
                        $storage->write($userData);
                        //var_dump($userData);exit;
                        /*
                        $objMenu = $sm->get('Panel\Model\GePrivilegioTable');
                        $objRol = $sm->get('Panel\Model\GeRolTable');
                        $objLogAcceso = $sm->get('Application\Model\AudAccesoTable');
                        $dataMenu = $objMenu->getMenuByUser($userData['codigo_usuario']);
                        
                        $userSession = new Container('usuario');
                        $userMenu = new Container('menu');
                        $userMenuAcceso = new Container('menu_acceso');
                        $userSession->codigo = !empty($userData['codigo_usuario']) ? $userData['codigo_usuario'] : '';
                        $userSession->apellidoPaterno = !empty($userData['apellido_paterno']) ? $userData['apellido_paterno'] : '';
                        $userSession->apellidoMaterno = !empty($userData['apellido_materno']) ? $userData['apellido_materno'] : '';
                        $userSession->nombre = !empty($userData['nombre_usuario']) ? $userData['nombre_usuario'] : '';
                        $userSession->dni = !empty($userData['dni']) ? $userData['dni'] : '';
                        $userSession->rolId = !empty($dataMenu[0]['rol_id']) ? (int)$dataMenu[0]['rol_id'] : 0;
                        $userSession->rol = !empty($dataMenu[0]['descripcion']) ? $dataMenu[0]['descripcion'] : '';
                        $userSession->codigoAgencia = !empty($userData['codigo_agencia']) ? $userData['codigo_agencia'] : '';
                        $userSession->esAdministrador = (!empty($userData['administrador']) && $userData['administrador'] == '1') ? true : false;
                        //$userSession->codigoAgencia
                        //$sessionUsuario->codigoEstacion
                        $userMenu->data = serialize($dataMenu);
                        $userMenuAcceso->data = serialize($objRol->obtenerAccesosPorRol($userSession->rolId));
                        $objLogAcceso->logAcceso();
                        */
                       return $this->redirect()->toRoute('cobranza-index');
                       break;
                    case Result::FAILURE_UNCATEGORIZED:
                        $message = "El usuario ingresado no tiene acceso.";
                        break;
                   default :
                       $message = "Usuario y/o clave incorrecto.";
                       break;

                }
            }
        }
        $viewmodel->message = $message;
        
        return $viewmodel;
    }
    
    public function logoutAction()
    {
	$auth = new AuthenticationService();

	if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $auth->clearIdentity();
            $sessionManager = new SessionManager();
            $sessionManager->forgetMe();
	}			

        $this->redirect()->toRoute('cobranza-login');		
    }
}
