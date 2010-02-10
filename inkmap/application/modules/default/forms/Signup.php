<?php

class  Form_Signup extends Zend_Dojo_Form
{
	public function init()
	{
		// Dojo-enable the form:
		Zend_Dojo::enableForm($this);
		$this->setName('Signup');
		$this->setAction('/lgn/signup')
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
                  'regExp'     => '^.{4,}$',  
                  'invalidMessage' => 'Insert your email',  
                  'validators' => array(  
                        'EmailAddress',  
						array('StringLength', false, 8)
				  ),
                  'filters'  => array('StringToLower'),  
		)
		);
			
			
		// PASSWORD
		$this->addElement(
       		'PasswordTextBox',   
       		'password1',   
			array(
				'id'			 => 'password1',
           		'label'          => 'Password',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{4,}$',  
           		'invalidMessage' => '密码太短',  
        		'validators'  => array(array('StringLength', false, 4))  
			)
		);
		
		$this->addElement(
       		'PasswordTextBox',   
       		'password2',   
			array(
				'id'			 => 'password2',
           		'label'          => 'Password',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{4,}$',  
           		'invalidMessage' => '两次密码不同',  
        		'validator'  =>  "return this.getValue() == dijit.byId('password1').getValue()"
			)
		);
		
			
		// SUBMIT
		$this->addElement(
       		'SubmitButton',   
       		'submit',   
			array(
           		'required'   => false,  
           		'ignore'     => true,  
           		'label'      => 'Submit Button!',  
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