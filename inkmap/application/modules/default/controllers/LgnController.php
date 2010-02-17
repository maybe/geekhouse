<?php
class LgnController extends Zend_Controller_Action {
	
	protected $_auth;
	
	/*
	 * init method
	 * */
	public function init() {
		$this->auth = Zend_Auth::getInstance ();
	}
	
	/*
	 * This action controls the head of every page
	 * */
	public function indexAction() {
		
		if ($this->auth->hasIdentity ()) {
			$identity = $this->auth->getIdentity ();
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
		if ($this->auth->getIdentity ()->role == 'user') {
			$this->_redirect ( "/" );
		}
		$signinForm = new Form_Signin ();
		if ($this->getRequest ()->isPost () && $signinForm->isValid ( $_POST )) {
			try {
				$data = $signinForm->getValues ();
				//get real password
				$user = new Common_Model_DbTable_User ();
				$getUser = $user->getUserByEmail ( $data ['email'] );
				$salt = $getUser->salt;
				$password = md5 ( $data ['password'] . $salt );
				//set up the auth adapter, get the default db adapter
				$db = Zend_Db_Table::getDefaultAdapter ();
				//create the auth adapter
				$config = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/db.ini', "production" );
				$authAdapter = new Zend_Auth_Adapter_DbTable ( $db, 'users', 
					$config->database->params->username, $config->database->params->password );
				$authAdapter->setIdentityColumn ( "email" );
				$authAdapter->setCredentialColumn ( "password" );
				$authAdapter->setIdentity ( $data ['email'] );
				$authAdapter->setCredential ( $password );
				//authenticate
				$result = $authAdapter->authenticate ();
				if ($result->isValid ()) {
					// store the username, role to authAdapter,
					// we can get role by  Zend_Auth::getInstance()->getIdentity()->role
					$storage = $this->auth->getStorage ();
					$storage->write ( $authAdapter->getResultRowObject ( null, 'password' ) );
					//go to index page
					//TODO: link to the former page
					Zend_Session::rememberMe ();
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
		$this->auth->clearIdentity ();
		Zend_Session::forgetMe ();
		$this->_redirect ( 'lgn/signin/' );
	}
	
	/*
	 * This is signup action
	 * */
	public function signupAction() {
		
		//if has logged, then redirect to homepage
		if ($this->auth->getIdentity ()->role == 'user') {
			$this->_redirect ( "/" );
		}

		$signupForm = new Form_Signup ();
		
		if ($this->getRequest ()->isPost () && $signupForm->isValid ( $_POST )) {
			try {
				$data = $signupForm->getValues ();
				$newUser = new Common_Model_DbTable_User ();
				$newUser->createUser ( $data ['email'], $data ['user_name'], $data ['password1'], $data ['role'] );
				//get real password
				$user = new Common_Model_DbTable_User ();
				$getUser = $user->getUserByEmail ( $data ['email'] );
				$salt = $getUser->salt;
				$password = md5 ( $data ['password1'] . $salt );
				$db = Zend_Db_Table::getDefaultAdapter ();
				//create the auth adapter
				$config = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/db.ini', "production" );
				$authAdapter = new Zend_Auth_Adapter_DbTable ( $db, 'users', 
					$config->database->params->username, $config->database->params->password );
				$authAdapter->setIdentityColumn ( "email" );
				$authAdapter->setCredentialColumn ( "password" );
				$authAdapter->setIdentity ( $data ['email'] );
				$authAdapter->setCredential ( $password );
				//authenticate
				$result = $authAdapter->authenticate ();
				if ($result->isValid ()) {
					// store the username, role to authAdapter,
					// we can get role by  Zend_Auth::getInstance()->getIdentity()->role
					$storage = $this->auth->getStorage ();
					$storage->write ( $authAdapter->getResultRowObject ( null, 'password' ) );
					//go to index page
				//TODO: link to the former page
				//	return $this->_redirect ( '/' );
				} else {
					throw new Exception ( "用户名或者密码不正确!" );
				}
			} catch ( Zend_Exception $e ) {
				$this->view->loginMessage = $e->getMessage();
			}
		}
		$this->view->signupForm = $signupForm;
	}
}
