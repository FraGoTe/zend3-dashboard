<?php

namespace Business\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\InlineScript;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\Url;

class FlashMsg extends AbstractHelper
{
    private $flashMessenger;
    private $inlineScript;
    private $Url;
    private $headLink;
    
    public function __construct(AbstractHelper $flashMessenger, InlineScript $inlineScript,HeadLink $headLink,Url $Url)
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
            echo "swal('" . $plugin->getCurrentSuccessMessages()[0][0] . "', '" . $plugin->getCurrentSuccessMessages()[0][1] . "', 'success');";
            $this->inlineScript->captureEnd();
        }
        
        if ($flashMsg->hasCurrentInfoMessages()) {
            $this->inlineScript->captureStart();
            echo "swal('" . $plugin->getCurrentInfoMessages()[0][0] . "', '" . $plugin->getCurrentInfoMessages()[0][1] . "', 'info');";
            $this->inlineScript->captureEnd();
        }
        
        if ($flashMsg->hasCurrentWarningMessages()) {
            $this->inlineScript->captureStart();
            echo "swal('" . $plugin->getCurrentWarningMessages()[0][0] . "', '" . $plugin->getCurrentWarningMessages()[0][1] . "', 'warning');";
            $this->inlineScript->captureEnd();
        }
        
        if ($flashMsg->hasCurrentErrorMessages()) {
            $this->inlineScript->captureStart();
            echo "sweetAlert('" . $plugin->getCurrentErrorMessages()[0][0] . "', '" . $plugin->getCurrentErrorMessages()[0][1] . "', 'error');";
            $this->inlineScript->captureEnd();
        }
        
    }
    
   
}