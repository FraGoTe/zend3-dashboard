<?php

namespace Negocio\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\FlashMessenger;
use Zend\View\Helper\InlineScript;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\BasePath;
use Zend\View\Helper\Url;

class FlashMsg extends AbstractHelper
{
    private $flashMessenger;
    private $inlineScript;
    private $Url;
    private $headLink;
    
    public function __construct(FlashMessenger $flashMessenger, InlineScript $inlineScript,HeadLink $headLink,Url $Url)
    {
        $this->flashMessenger = $flashMessenger;
        $this->inlineScript = $inlineScript;
        $this->headLink = $headLink;
        $this->Url = $Url;
    }
    /**
     * Collect all messages from previous and current request
     * clear current messages because we will show it
     * add JS files
     * add JS notifications
     */
    public function __invoke()
    {
        $flashMsg = $this->flashMessenger;
        $plugin = $this->flashMessenger->getPluginFlashMessenger();

        if ($flashMsg->hasCurrentSuccessMessages()) {
            $this->inlineScript->captureStart();
            echo "showStackContext('success', '" . $plugin->getCurrentSuccessMessages()[0][0] . "', '" . $plugin->getCurrentSuccessMessages()[0][1] . "');";
            $this->inlineScript->captureEnd();
        }
        
        if ($flashMsg->hasCurrentInfoMessages()) {
            $this->inlineScript->captureStart();
            echo "showStackContext('info', '" . $plugin->getCurrentInfoMessages()[0][0] . "', '" . $plugin->getCurrentInfoMessages()[0][1] . "');";
            $this->inlineScript->captureEnd();
        }
        
        if ($flashMsg->hasCurrentWarningMessages()) {
            $this->inlineScript->captureStart();
            echo "showStackContext('warning', '" . $plugin->getCurrentWarningMessages()[0][0] . "', '" . $plugin->getCurrentWarningMessages()[0][1] . "');";
            $this->inlineScript->captureEnd();
        }
        
        if ($flashMsg->hasCurrentErrorMessages()) {
            $this->inlineScript->captureStart();
            echo "showStackContext('error', '" . $plugin->getCurrentErrorMessages()[0][0] . "', '" . $plugin->getCurrentErrorMessages()[0][1] . "');";
            $this->inlineScript->captureEnd();
        }
        
    }
    
   
}