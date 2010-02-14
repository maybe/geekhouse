<?php
class InkMap_Controller_Plugin_Session extends Zend_Controller_Plugin_Abstract {
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$config = new Zend_Config_Ini ( '/configs/session.ini', 'production' );
		Zend_Session::setOptions ( $config->toArray () );
	}
}