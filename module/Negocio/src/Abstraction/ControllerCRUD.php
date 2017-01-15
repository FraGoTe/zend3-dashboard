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
    protected $tableIds;
    protected $columnasListar;
    protected $describeColumnas;
    protected $indexRedirect;
    
    public function getTableIds()
    {
        return $this->tableIds;
    }

    public function setTableIds($tableIds)
    {
        $this->tableIds = $tableIds;
        return $this;
    }
    
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getColumnasListar()
    {
        return $this->columnasListar;
    }

    public function getDescribeColumnas()
    {
        return $this->describeColumnas;
    }

    public function getIndexRedirect()
    {
        return $this->indexRedirect;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function setColumnasListar($columnasListar)
    {
        $this->columnasListar = $columnasListar;
        return $this;
    }

    public function setDescribeColumnas($describeColumnas)
    {
        $this->describeColumnas = $describeColumnas;
        return $this;
    }

    public function setIndexRedirect($indexRedirect)
    {
        $this->indexRedirect = $indexRedirect;
        return $this;
    }
    
    public function __construct($table)
    {
        $this->table = $table;
    }
    
    public function indexAction()
    {   
        if (!empty($this->getIndexRedirect())) {
            $this->redirect()->toRoute($this->getIndexRedirect());	
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

        $paginator->setItemCountPerPage(7);
        
        $viewModel = new ViewModel();
        $viewModel->titulo = $this->getTitulo();
        $viewModel->paginator = $paginator;
        $viewModel->urlPrefix = $this->getUrlPrefix();
        $viewModel->columnas = $this->getColumnasListar();
        $viewModel->setTemplate('negocio/crud/listar.phtml');

        return $viewModel;
    }
    
    public function agregarAction()
    {		
        $form = new Form('agregar');
        
        $request   = $this->getRequest();

        $viewModel = new ViewModel();
        $viewModel->titulo = $this->getTitulo();
        $viewModel->form = $form;
        $viewModel->campos = $this->getDescribeColumnas();
        $viewModel->camposDescripcion = $this->getColumnasListar();

        $viewModel->setTemplate('negocio/crud/agregar.phtml');
        

        if (!$request->isPost()) {
            return $viewModel;
        }

        $form->setInputFilter($this->table->getInputFilter($this->getDescribeColumnas()));
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewModel;
        }

        try {
            $data = (array)$request->getPost();
            unset($data['submit']);
            unset($data['reset']);
            $inserted = $this->table->insertData($data);
            $viewModel->result = $inserted['result'];

        } catch (\Exception $ex) {
            $viewModel->result = 0;
            var_dump($ex->getMessage());
        }

        return $viewModel;
    }
    
    public function editarAction()
    {
        $paramsId = $this->getTableIds();
        
        foreach ($paramsId as $tableId) {
            $id[$tableId] = $this->params($tableId);
        }
                
        if (empty($id)) {
            return $this->redirect()->toRoute($this->getIndexRedirect());
        }

        try {
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveAlbum($album);

        if (!empty($this->indexRedirect)) {
            $this->redirect()->toRoute($this->getIndexRedirect());	
        } else {
            $viewModel = new ViewModel();
            $viewModel->setTemplate('negocio/crud/index.phtml');
            
            return $viewModel;
        }
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
