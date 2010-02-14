<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initAutoload() {
		//$layout = Zend_Controller_Action_HelperBroker::addHelper(new InkMap_Controller_Action_Helper_LayoutLoader());
		
		$resourceLoader = new Zend_Loader_Autoloader_Resource ( array (
			'basePath' => APPLICATION_PATH."/common", 
			'namespace' => 'Common', 
			'resourceTypes' => array (
				'acl' => array (
				'path' => 'acls/', 
				'namespace' => 'Acl' )
				, 
				'form' => array (
				'path' => 'forms/', 
				'namespace' => 'Form' )
				, 
				'model' => array (
				'path' => 'models/',
				'namespace' => 'Model' )
				)
			)
		);
	}
}


