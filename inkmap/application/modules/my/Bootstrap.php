<?php

class My_Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected function _initAutoload()
	{
		$autoloader_admin = new Zend_Application_Module_Autoloader(array(
			'namespace' => 'My_',
			'basePath'  => APPLICATION_PATH .'/modules/my'));
	}

	protected function _initViewHelpers()
	{
		//    $this->bootstrap('layout');
		//    $layout = $this->getResource('layout');
		//    $view = $layout->getView();
		//    $view->doctype('XHTML1_STRICT');
		//    $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
		//    $view->headTitle()->setSeparator(' - ');
		//    $view->headTitle('Zend Framework Tutorial');
	}
}

