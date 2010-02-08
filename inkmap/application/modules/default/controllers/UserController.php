<?php
class IndexController extends Zend_Controller_Action
{
	public function init(){}

	public function indexAction(){}
	
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