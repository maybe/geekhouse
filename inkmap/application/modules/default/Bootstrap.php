<?php

class Default_Bootstrap extends Zend_Application_Module_Bootstrap 

{
	protected function _initAutoload()
	{
			$autoloader_default = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath'  => APPLICATION_PATH .'/modules/default'));
	}
}

