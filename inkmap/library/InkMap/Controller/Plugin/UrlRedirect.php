<?php
class InkMap_Controller_Plugin_UrlRedirect extends Zend_Controller_Plugin_Abstract {
	
	public function routeShutdown(Zend_Controller_Request_Abstract $request) {
		
		$front = Zend_Controller_Front::getInstance ();		
		$dispatcher = $front->getDispatcher ();

		if ( $dispatcher->isDispatchable ( $request ) ) {
			return;
		} else {
			$response = $this->getResponse ();
			$response->setRedirect ( '/' );
			$response->sendResponse ();
			exit ();
		}
	}
}