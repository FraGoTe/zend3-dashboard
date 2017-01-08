<?php

namespace Negocio\Abstraction;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Form\Form;

/**
 * Description of Abstraction/Controller
 *
 * @author Francis Gonzales <fgonzalestello91@gmail.com>
 */
abstract class ControllerCRUD extends AbstractActionController {
    
    private $table; 
    protected $titulo;
    protected $columnasListar;
    protected $describeColumnas;
    protected $indexRedirect;
    
    public function __construct($table)
    {
        $this->table = $table;
    }
    
    public function indexAction()
    {   
        if (!empty($this->indexRedirect)) {
            $this->redirect()->toRoute($this->indexRedirect);	
        } else {
            $viewModel = new ViewModel();
            $viewModel->setTemplate('negocio/crud/index.phtml');
            
            return $viewModel;
        }
    }
    
    public function listarAction()
    {		
        $paginator = $this->table->fetchAll(true);

        $page = (int) $this->params()->fromQuery('page', 1);
        $page = ($page < 1) ? 1 : $page;
        $paginator->setCurrentPageNumber($page);

        $paginator->setItemCountPerPage(10);
        
        $viewModel = new ViewModel();
        $viewModel->titulo = $this->titulo;
        $viewModel->paginator = $paginator;
        $viewModel->urlPrefix = $this->getUrlPrefix();
        $viewModel->columnas = $this->columnasListar;
        $viewModel->setTemplate('negocio/crud/listar.phtml');

        return $viewModel;
    }
    
    public function agregarAction()
    {		
        
        $viewModel = new ViewModel();
        $viewModel->titulo = $this->titulo;
        $viewModel->form = new Form('agregar');
        $viewModel->campos = $this->describeColumnas;
        $viewModel->camposDescripcion = $this->columnasListar;

        $viewModel->setTemplate('negocio/crud/agregar.phtml');

        return $viewModel;
    }
    
    private function getCurrentClass()
    {
        return get_called_class();
    }
    
    private function getUrlPrefix()
    {
        return strtolower(str_replace(array('\Controller\\', 'Controller'), array('-', ''), $this->getCurrentClass())) . '-';
    }
}
