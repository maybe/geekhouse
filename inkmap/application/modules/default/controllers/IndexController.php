<?php

class IndexController extends Zend_Controller_Action {
	
	public function __call($method, $args) {
		if ('Action' == substr ( $method, - 6 )) {
			$controller = $this->getRequest ()->getControllerName ();
			$url = '/';
			return $this->_redirect ( $url );
		}
		throw new Exception ( 'Invalid method' );
	}
	
	public function init() {
	}
	public function indexAction() {
	}

}



