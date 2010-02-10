<?php
class LgnController extends Zend_Controller_Action {
	
	/*
	 * This action controls the head of every page
	 * */
	public function indexAction() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$identity = $auth->getIdentity ();
			$this->view->user_name = $identity->user_name;
			$this->view->auth = true;
		} else {
			$this->view->auth = false;
		}
	}
	
	/*
	 * This is signin action
	 * */
	public function signinAction() {
		//if has logged, then redirect to homepage
		if (Zend_Auth::getInstance ()->getIdentity ()->role == 'user') {
			$this->_redirect ( "/" );
		}
		Zend_Dojo::enableView ( $this->view );
		$signinForm = new Form_Signin ();
		if ($this->getRequest ()->isPost () && $signinForm->isValid ( $_POST )) {
			try {
				$data = $signinForm->getValues ();
				//get real password
				$user = new Model_DbTable_User ();
				$getUser = $user->getUserByEmail ( $data ['email'] );
				$salt = $getUser->salt;
				$password = md5 ( $data ['password'] . $salt );
				//set up the auth adapter, get the default db adapter
				$db = Zend_Db_Table::getDefaultAdapter ();
				//create the auth adapter
				$config = new Zend_Config_Xml ( APPLICATION_PATH . '/configs/db.xml' );
				$authAdapter = new Zend_Auth_Adapter_DbTable ( $db, 'users', $config->params->username, $config->params->password );
				$authAdapter->setIdentityColumn ( "email" );
				$authAdapter->setCredentialColumn ( "password" );
				$authAdapter->setIdentity ( $data ['email'] );
				$authAdapter->setCredential ( $password );
				//authenticate
				$result = $authAdapter->authenticate ();
				if ($result->isValid ()) {
					// store the username, role to authAdapter,
					// we can get role by  Zend_Auth::getInstance()->getIdentity()->role
					$auth = Zend_Auth::getInstance ();
					$storage = $auth->getStorage ();
					$storage->write ( $authAdapter->getResultRowObject ( null, 'password' ) );
					//go to index page
					//TODO: link to the former page
					return $this->_redirect ( '/' );
				} else {
					throw new Exception ( "用户名或者密码不正确" );
				}
			} catch ( Exception $e ) {
				$this->view->loginMessage = "用户名或者密码不正确";
				if ($e->getMessage () == "无此用户！") {
					$this->view->loginMessage = "用户名或者密码不正确";
				}
			
			}
		}
		$this->view->signinForm = $signinForm;
	}
	
	/*
	 * This is signout action
	 * */
	public function signoutAction() {
		$authAdapter = Zend_Auth::getInstance ();
		$authAdapter->clearIdentity ();
		$this->_redirect ( 'lgn/signin/' );
	}
	
	/*
	 * This is signup action
	 * */
	public function signupAction() {
		
		//if has logged, then redirect to homepage
		if (Zend_Auth::getInstance ()->getIdentity ()->role == 'user') {
			$this->_redirect ( "/" );
		}
		
		Zend_Dojo::enableView ( $this->view );
		$signupForm = new Form_Signup ();
		
		if ($this->getRequest ()->isPost () && $signupForm->isValid ( $_POST )) {
			try {
				$data = $signupForm->getValues ();
				$newUser = new Model_DbTable_User ();
				$newUser->createUser ( $data ['email'], $data ['user_name'], $data ['password1'], $data ['role'] );
				//get real password
				$user = new Model_DbTable_User ();
				$getUser = $user->getUserByEmail ( $data ['email'] );
				$salt = $getUser->salt;
				$password = md5 ( $data ['password1'] . $salt );
				$db = Zend_Db_Table::getDefaultAdapter ();
				//create the auth adapter
				$config = new Zend_Config_Xml ( APPLICATION_PATH . '/configs/db.xml' );
				$authAdapter = new Zend_Auth_Adapter_DbTable ( $db, 'users', $config->params->username, $config->params->password );
				$authAdapter->setIdentityColumn ( "email" );
				$authAdapter->setCredentialColumn ( "password" );
				$authAdapter->setIdentity ( $data ['email'] );
				$authAdapter->setCredential ( $password );
				//authenticate
				$result = $authAdapter->authenticate ();
				if ($result->isValid ()) {
					// store the username, role to authAdapter,
					// we can get role by  Zend_Auth::getInstance()->getIdentity()->role
					$auth = Zend_Auth::getInstance ();
					$storage = $auth->getStorage ();
					$storage->write ( $authAdapter->getResultRowObject ( null, 'password' ) );
					//go to index page
				//TODO: link to the former page
				//	return $this->_redirect ( '/' );
				} else {
					throw new Exception ( "用户名或者密码不正确!" );
				}
			} catch ( Zend_Exception $e ) {
				$this->view->loginMessage = $e;
			}
		}
		$this->view->signupForm = $signupForm;
	}
}
