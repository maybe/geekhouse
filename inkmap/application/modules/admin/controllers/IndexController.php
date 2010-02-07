<?php

class Admin_IndexController extends Zend_Controller_Action
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
		$user = new Admin_Model_DbTable_User();
		$this->view->users = $user->fetchAll();
	}


}



