<?php
/**
 * Description of ModuleConditionalLoader
 *
 * @author fragote
 */
namespace Business\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ModuleConditionalLoader extends AbstractPlugin
{
    public $config;
    
    public function __construct($config)
    {
        $this->config = $config;
    }
    
    public function isModuleAllowed()
    {
        $controller = $this->getController();        
        $controllerClass = get_class($controller);
        
        $namespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $modulo = strtolower($namespace);
        
        if (!empty($this->config['modulo_permisos'])) {
            // Validacion por Modulo
            if (!empty($this->config['modulo_permisos'][$modulo])) {
                $configModulo = $this->config['modulo_permisos'][$modulo];
                // Validacion de Puertos
                if (!empty($configModulo['puerto'])) {
                    $puertoEsperado = $configModulo['puerto'];
                    $puertoServidor = $_SERVER['SERVER_PORT'];

                    if ($puertoEsperado !== $puertoServidor) {
                        $redirector = $controller->getPluginManager()->get('Redirect');
                        return $redirector->toRoute('home');
                    }
                }
            }
        }
    }
}