<?php

class My_Form_AccountPassword extends Zend_Form {
	
	public $elementDecorators = array(
        'ViewHelper',
        'Errors',
		array('Description'),
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array('Label', array('tag' => 'td','class'=>'formLabel')),
   		array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'class'=>'formRow')),
        );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );
	
	public function init() {
		
		$this->setName ( 'password' );
		$this->setAction ( '/my/account/password' )->setMethod ( 'post' );
		
		// PASSWORD1
		$this->addElement(
       		'Password',   
       		'password1', 
			array(
           		'label'          => '密码 : ',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{6,}$',  
				'decorators' => $this->elementDecorators,
        		'validators'  => array(array('StringLength', false, 6))
			)
		);
		
		// PASSWORD2
		$this->addElement(
       		'Password',   
       		'password2', 
			array(
           		'label'          => '输入新密码 : ',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{6,}$',  
				'decorators' => $this->elementDecorators,
        		'validators'  => array(array('StringLength', false, 6))
			)
		);
		// PASSWORD3
		$this->addElement(
       		'Password',   
       		'password3', 
			array(
           		'label'          => '重复输入 : ',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{6,}$',  
				'decorators' => $this->elementDecorators,
        		'validators'  => array(array('StringLength', false, 6))
			)
		);
		
		// SUBMIT
		$this->addElement ( 'Submit', 'submit', array (
			'required' => false, 
			'ignore' => true, 
			'decorators' => $this->buttonDecorators,
		) );

		//		$this->clearDecorators();
		$this->setDecorators(array(
   			'FormElements',
   			array('HtmlTag', array('tag' => 'table')),
    		'Form',
		));
	}
}