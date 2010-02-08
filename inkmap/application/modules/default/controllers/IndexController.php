<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
	}

	public function indexAction()
	{
	}

	public function showAction()
	{
		$this->view->title = "Test";
		$this->view->headTitle($this->view->title);
		$user = new Model_DbTable_User();
		$this->view->users = $user->fetchAll();
	}

	public function loginAction(){

		Zend_Dojo::enableView($this->view);
		$form = new Form_Login();
		if ($this->getRequest()->isPost()) {
			
				// just dump the data for now
				$data = $form->getValues();
				$this->_forward('index');
				// process the data
			
		}
		 
		$this->view->form=$form;

		 
	}


}



