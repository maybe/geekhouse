<?php

class My_Form_AccountSettings extends Zend_Dojo_Form {
	
	public function init() {
		
		Zend_Dojo::enableForm ( $this );
		$this->setName ( 'Login' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		$this->setAction ( '/my/account/settings' )->setMethod ( 'post' );
		
		// EMAIL
		$this->addElement ( 'TextBox', 'email', array ('value' => '', 'label' => '电子邮箱 : ', 'trim' => true, 'lowercase' => true, 'required' => true, 'regExp' => '^.{6,}$', 'invalidMessage' => '邮箱太短！', 'validators' => array ('EmailAddress', array ('StringLength', false, 6 ) ), 'filters' => array ('StringToLower' ) ) );
		
		// PASSWORD
		$this->addElement ( 'PasswordTextBox', 'password', array ('label' => '密码 : ', 'required' => true, 'trim' => true, 'regExp' => '^.{4,}$', 'invalidMessage' => '密码太短！', 'validators' => array (array ('StringLength', false, 4 ) ) ) );
		
		// SUBMIT
		$this->addElement ( 'SubmitButton', 'submit', array ('required' => false, 'ignore' => true, 'label' => '进入' ) );
		
		$this->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'dl', 'class' => 'zend_form' ) ), array ('Description', array ('placement' => 'prepend' ) ), 'Form' ) );
	}

}