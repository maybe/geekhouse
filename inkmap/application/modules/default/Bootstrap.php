<?php

class Default_Bootstrap extends Zend_Application_Module_Bootstrap

{
	protected function _initAutoload()
	{
		$autoloader_default = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath'  => APPLICATION_PATH .'/modules/default'));
			
	}

	protected function _initView(){
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		$view->addHelperPath('Zend/Dojo/View/Helper', 'Zend_Dojo_View_Helper');

		return $view;
	}
}

