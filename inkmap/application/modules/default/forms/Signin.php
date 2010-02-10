<?php

class  Form_Signin extends Zend_Dojo_Form
{
	public function init()
	{
		// Dojo-enable the form:
		Zend_Dojo::enableForm($this);
		$this->setName('Login');
		$this->setAction('/lgn/signin')
		->setMethod('post');
			
		// EMAIL
		$this->addElement(
                 'ValidationTextBox',   
                 'email',   
		array(
                  'value'      => '',  
                  'label'      => 'Email address : ',  
                  'trim'       => true,  
                  'lowercase'  => true,  
                  'required'   => true,  
                  'regExp'     => '^.{6,}$',  
                  'invalidMessage' => '邮箱太短！',  
                  'validators' => array(  
                        'EmailAddress',  
						array('StringLength', false, 6)
				  ),
                  'filters'  => array('StringToLower'),  
		)
		);
			
			
		// PASSWORD
		$this->addElement(
       		'PasswordTextBox',   
       		'password',   
			array(
           		'label'          => 'Password : ',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{4,}$',  
           		'invalidMessage' => '密码太短！',  
        		'validators'  => array(array('StringLength', false, 4))  
			)
		);
			
		// SUBMIT
		$this->addElement(
       		'SubmitButton',   
       		'submit',   
			array(
           		'required'   => false,  
           		'ignore'     => true,  
           		'label'      => '进入',  
			)
		);
			
		$this->setDecorators(array(
            'FormElements',
			array('HtmlTag', array('tag' => 'dl', 'class' => 'zend_form')),
			array('Description', array('placement' => 'prepend')),
            	'Form'
        ));
	}

}