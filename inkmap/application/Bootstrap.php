<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{



		$layout = Zend_Controller_Action_HelperBroker::addHelper(new InkMap_Controller_Action_Helper_LayoutLoader());
			
	}

	protected function _initControllers()
	{
//		$this->bootstrap(‘FrontController’);
//
//		$acl = new MyAcl;
//		$auth = Zend_Auth::getInstance();
//		$this->frontController->registerPlugin(new My_Plugin_Auth($auth, $acl));
	}


}


