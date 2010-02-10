<?php
class LgnController extends Zend_Controller_Action{


	public function indexAction(){}

	public function signinAction(){

		//if has logged, then redirect to homepage
		if(Zend_Auth::getInstance()->getIdentity()->role=='user') {

			$this->_redirect("/");

		}
		Zend_Dojo::enableView($this->view);
		$signinForm = new Form_Signin();
		if ($this->getRequest()->isPost() && $signinForm->isValid($_POST)) {
			$data = $signinForm->getValues();
			//set up the auth adapter, get the default db adapter
			$db = Zend_Db_Table::getDefaultAdapter();
			//create the auth adapter
			$authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'root', '');
			$authAdapter->setIdentityColumn("email");
			$authAdapter->setCredentialColumn("password");
			$authAdapter->setIdentity($data['email']);
			$authAdapter->setCredential($data['password']);
			//authenticate
			$result = $authAdapter->authenticate();
			if ($result->isValid()) {
				// store the username, role to authAdapter,
				// we can get role by  Zend_Auth::getInstance()->getIdentity()->role
				$auth = Zend_Auth::getInstance();
				$storage = $auth->getStorage();
				$storage->write($authAdapter->getResultRowObject(
				array('user_name' , 'role')));

				//go to index page
				//TODO: link to the former page
				return $this->_redirect('/');
			} else {
				$this->view->loginMessage = "用户名或者密码不正确";
			}
		}
		$this->view->signinForm=$signinForm;
	}

	public function signoutAction(){
		$authAdapter = Zend_Auth::getInstance();
		$authAdapter->clearIdentity();
		$this->_redirect('lgn/signin/');
	}

	public function signupAction(){

	}

}
