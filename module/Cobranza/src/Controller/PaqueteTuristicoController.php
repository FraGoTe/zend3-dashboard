<?php

namespace Cobranza\Controller;

use Negocio\Abstraction\ControllerCRUD;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Form\Form;

class PaqueteTuristicoController extends ControllerCRUD
{   
    public function __construct($table)
    {
        parent::__construct($table);
        $describeColumnas = array(
            'id' => [
                'PK' => 1,
                'AI' => 1
            ],
            'colegio_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5,
                'FK' => 1,
                'FUNC' => 'getColegio',
            ],
            'salon_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200,
                'FK' => 1,

            ],
            'titulo' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'fecha_viaje' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'DATE',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200,
                'DATE' => 1
            ],
            'destino' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'moneda_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5,
                'FK' => 1,
                'FUNC' => 'getMoneda',
            ],
            'precio_viaje' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'documento_adicional' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 200
            ],
            'cta_bancaria_id' => [
                'PK' => 0,
                'AI' => 0,
                'TIPO' => 'VARCHAR',
                'REQUIRED' => true,
                'MIN_LENGHT' => 1,
                'LENGHT' => 5,
                'FK' => 1,
            ],
        );
            
        $columnasListar = array(
            'id' => 'ID',
            'titulo' => 'Titulo',
            'fecha_viaje' => 'Fecha Viaje',
            'destino' => 'Destino',
            'moneda_id' => 'Moneda',
            'precio_viaje' => 'Precio',
            'salon_id' => 'Salón',
            'documento_adicional' => 'Documento Adicional',
            'cta_bancaria_id' => 'Cta Bancaria',
            'colegio_id' => 'Colegio',
            'tipo_viaje_id' => 'Salón',
        );
        
        $indexRedirect = 'cobranza-paqueteturistico-listar';
        
        $tableId = array('id');
        
        $dscEliminar = array(
            'id', 'titulo'
        );
        
        $this->setTitulo('Paquete Turístico');
        $this->setColumnasListar($columnasListar);
        $this->setIndexRedirect($indexRedirect);
        $this->setDescribeColumnas($describeColumnas);
        $this->setTableIds($tableId);
        $this->setDscEliminar($dscEliminar);
        $this->table = $table;
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
        
        if (!$request->isPost()) {
            $viewModel->fk = $this->getDataFk($columnasDetalle);
            $viewModel->salones = $this->table->getSalon();
            $viewModel->ctasbancarias = $this->table->getCtaBancaria();

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
}
