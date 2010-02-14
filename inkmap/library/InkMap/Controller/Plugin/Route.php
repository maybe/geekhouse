<?php
class InkMap_Controller_Plugin_Route extends Zend_Controller_Plugin_Abstract {
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$front = Zend_Controller_Front::getInstance ();
		$router = $front->getRouter ();
		$config = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/route.ini', 'production' );
		//	$router = new Zend_Controller_Router_Rewrite();
		$router->addConfig ( $config, 'routes' );
	
	}
}