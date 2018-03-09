<?php

namespace Business\Abstraction;

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
abstract class ControllerCRUD extends AbstractActionController 
{
    
    private $table; 
    protected $titulo;
    protected $tableIds;
    protected $columnasListar;
    protected $describeColumnas;
    protected $indexRedirect;
    protected $dscEliminar;

    public function getDscEliminar()
    {
        return $this->dscEliminar;
    }

    public function setDscEliminar($dscEliminar)
    {
        $this->dscEliminar = $dscEliminar;
        return $this;
    }

            
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
            $viewModel->setTemplate('business/crud/index.phtml');
            
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
        $viewModel->dscColumn = $this->getDescribeColumnas();
        $viewModel->fk = $this->getDataFk($this->getDescribeColumnas());

        $viewModel->setTemplate('business/crud/listar.phtml');
        
        return $viewModel;
    }
    
    public function agregarAction()
    {		
        $form = new Form('agregar');
        
        $request   = $this->getRequest();
        
        $columnasDetalle = $this->getDescribeColumnas();

        $viewModel = new ViewModel();
        $viewModel->titulo = $this->getTitulo();
        $viewModel->form = $form;
        $viewModel->campos = $columnasDetalle;
        $viewModel->camposDescripcion = $this->getColumnasListar();

        $viewModel->setTemplate('business/crud/agregar.phtml');
        
        if (!$request->isPost()) {
            $viewModel->fk = $this->getDataFk($columnasDetalle);
            
            return $viewModel;
        }

        $form->setInputFilter($this->table->getInputFilter($this->getDescribeColumnas()));
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            $mensajeValidacion = '';
            foreach ($form->getInputFilter()->getInvalidInput() as $error) {
                foreach ($error->getMessages() as $keyId => $detalle) {
                    $mensajeValidacion .= $detalle;
                }
            }
            
            $this->flashMessenger()->addWarningMessage(['El formulario no es válido', $mensajeValidacion]);
            
            return $viewModel;
        }

        try {
            $data = (array)$request->getPost();
            unset($data['submit']);
            unset($data['reset']);
            $inserted = $this->table->insertData($data);
            $viewModel->result = $inserted['result'];
            
            $dscItem = $this->obtenerDatosImportantes($this->getDscEliminar(), [$data]);
            $this->flashMessenger()->addSuccessMessage(['Agregado Correctamente', 'Se agregó correctamente el registro ' . $dscItem]);
            
            $this->redirect()->toRoute($this->getIndexRedirect());
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage(['Hemos Detectado Problemas', 'Detalle del error: ' . $ex->getMessage()]);
            $viewModel->result = 0;
        }
        
        return $viewModel;
    }
    
    public function editarAction()
    {
        $viewModel = new ViewModel();
        $request = $this->getRequest();

        $paramsId = $this->getTableIds();
        
        foreach ($paramsId as $tableId) {
            $id[$tableId] = $this->params($tableId);
        }
                
        if (empty($id)) {
            return $this->redirect()->toRoute($this->getIndexRedirect());
        }

        $data = $this->table->getData($id);

        $form = new Form('agregar');

        $viewModel->titulo = $this->getTitulo();
        $viewModel->form = $form;
        $viewModel->campos = $this->getDescribeColumnas();
        $viewModel->defaultValue = $data['data']->toArray()[0];
        $viewModel->camposDescripcion = $this->getColumnasListar();
        $viewModel->isEdit = true;
        $viewModel->setTemplate('business/crud/agregar.phtml');
        
        if (!$request->isPost()) {
            $viewModel->fk = $this->getDataFk($this->getDescribeColumnas());

            return $viewModel;
        }
       
        $form->setInputFilter($this->table->getInputFilter($this->getDescribeColumnas()));
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            $mensajeValidacion = '';
            foreach ($form->getInputFilter()->getInvalidInput() as $error) {
                foreach ($error->getMessages() as $keyId => $detalle) {
                    $mensajeValidacion .= $detalle;
                }
            }
            
            $this->flashMessenger()->addWarningMessage(['El formulario no es válido', $mensajeValidacion]);
            
            return null;
        }

        $setValues = $request->getPost()->toArray();
        $intersec = array_intersect_key($setValues, $id);
        
        foreach ($setValues as $key => $value) {
            if (array_key_exists($key, $intersec)) {
                unset($setValues[$key]);
            }
        }
        
        unset($setValues['submit']);

        $this->table->updateData($id, $setValues);

        if (!empty($this->indexRedirect)) {
            $dscItem = $this->obtenerDatosImportantes($this->getDscEliminar(), [array_merge($setValues, $id)]);
            $this->flashMessenger()->addInfoMessage(['Actualizado Correctamente', 'Se actualizó correctamente el registro ' . $dscItem]);
            $this->redirect()->toRoute($this->getIndexRedirect());	
        } else {
            $viewModel->setTemplate('business/crud/index.phtml');
            
            return $viewModel;
        }
    }
    
    public function eliminarAction()
    {
        $viewModel = new ViewModel();
        $paramsId = $this->getTableIds();
        
        foreach ($paramsId as $tableId) {
            $id[$tableId] = $this->params($tableId);
        }        
        
        if (empty($id)) {
            return $this->redirect()->toRoute($this->getIndexRedirect());
        }

        $request = $this->getRequest();
        
        $dataDelete = $this->table->getData($id);
        $dataDelete = $dataDelete['data'];
        $dataDeleDesc = $dataDelete->toArray();
        $dscItemEliminar = $this->obtenerDatosImportantes($this->getDscEliminar(), $dataDeleDesc);
        
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            $eliminadoCorrectamente = false;
            if ($del == 'Si') {
                try {
                    $eliminadoCorrectamente = $this->table->deleteData($id);
                    
                    if (!$eliminadoCorrectamente) {
                        $this->flashMessenger()->addErrorMessage(['Hemos Detectado Problemas', 'No se pudo elimnar el registro, revise que no hayan datos relacionados.']);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage(['Hemos Detectado Problemas', 'Detalle del error: ' . $e->getMessage()]);
                }
            }
            
            if ($eliminadoCorrectamente) {
                $this->flashMessenger()->addInfoMessage(['Eliminado Correctamente', 'Se eliminó correctamente el registro ' . $dscItemEliminar]);
                $this->redirect()->toRoute($this->getIndexRedirect());
            }	
        }

        $viewModel->setTemplate('business/crud/eliminar.phtml');
        
        $viewModel->ids = $id;
        $viewModel->titulo = 'Eliminar ' . $this->getTitulo();
        $viewModel->data = $dataDelete;
        $viewModel->dscItemEliminar = $dscItemEliminar;
        
        return $viewModel;
    }
    
    public function obtenerDatosImportantes($descripcionImportant, $dataDeleDesc)
    {
        $dscItemEliminar = '';
        foreach ($descripcionImportant as $desDel) {
            $dscItemEliminar .= $dataDeleDesc[0][$desDel] . ' ';
        }
        
        return $dscItemEliminar;
    }
    
    public function getDataFk($columnasDetalle)
    {
        $data = [];

        foreach ($columnasDetalle as $value) {
            if (!empty($value['FK']) && !empty($value['FUNC'])) {
                $fn = $value['FUNC'];
                $data[$fn] = $this->table->$fn();
            }
        }
        
        return $data;
    }
    
    private function getCurrentClass()
    {
        return get_called_class();
    }
    
    public function getUrlPrefix()
    {
        return strtolower(str_replace(array('\Controller\\', 'Controller'), array('-', ''), $this->getCurrentClass())) . '-';
    }
}
