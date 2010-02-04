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
		$this->view->headTitle($this->view->title, 'PREPEND');
		$users = new Model_DbTable_Users();
		$this->view->users = $users->fetchAll();
	}


}



