<?php
class InkMap_Controller_Action_Helper_LayoutLoader extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {
        $bootstrap = $this->getActionController()
                          ->getInvokeArg('bootstrap');
        $config = $bootstrap->getOptions();
        $module = $this->getRequest()->getModuleName();
        if(isset($config[$module]['resources']['layout']['layoutPath'])){
            $layoutPath = $config[$module]['resources']['layout']['layoutPath'];
            $this->getActionController()
                 ->getHelper('layout')
                 ->setLayoutPath($layoutPath);
        }
    }
}