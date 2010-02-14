<?php
class InkMap_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		// set up acl
		$acl = new Zend_Acl ();
		
		// add the roles
		$acl->addRole ( new Zend_Acl_Role ( 'guest' ) );
		$acl->addRole ( new Zend_Acl_Role ( 'user' ), 'guest' );
		$acl->addRole ( new Zend_Acl_Role ( 'administrator' ), 'user' );
		
		// add resources
		/** Default module */
		$acl->add ( new Zend_Acl_Resource ( 'default' ) );
		$acl->add ( new Zend_Acl_Resource ( 'default:index' ), 'default' );
		$acl->add ( new Zend_Acl_Resource ( 'default:lgn' ), 'default' );
		$acl->add ( new Zend_Acl_Resource ( 'default:my' ), 'default' );
		
				/** Default module */
		$acl->add ( new Zend_Acl_Resource ( 'my' ) );
		$acl->add ( new Zend_Acl_Resource ( 'my:index' ), 'my' );
		$acl->add ( new Zend_Acl_Resource ( 'my:account' ), 'my' );
		
		/** Admin module */
		$acl->add ( new Zend_Acl_Resource ( 'admin' ) );
		$acl->add ( new Zend_Acl_Resource ( 'admin:index' ), 'admin' );
		$acl->add ( new Zend_Acl_Resource ( 'admin:page' ), 'admin' );
		
		/** Creating permissions */
		$acl->allow ( 'guest', 'default' );
		
		// users can also work with content
		//$acl->allow('user', 'default:my');
		$acl->allow ( 'user', 'default' );
		$acl->allow("user","my");
		// administrators can do anything
		$acl->allow ( 'administrator', null );
		
		// fetch the current user
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$identity = $auth->getIdentity ();
			$role = strtolower ( $identity->role );
		} else {
			$role = 'guest';
		}
		
		$module = $request->module;
		$controller = $request->controller;
		$action = $request->action;
		
		if (! $acl->isAllowed ( $role, $module, $controller, $action )) {
			if ($role == 'guest') {
				$request->setModuleName ( 'default' );
				$request->setControllerName ( 'lgn' );
				$request->setActionName ( 'signin' );
			} else {
				$request->setControllerName ( 'error' );
				$request->setActionName ( 'signin' );
			}
		}
	
	}
}
