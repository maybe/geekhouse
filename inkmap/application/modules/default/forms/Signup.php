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
			
		// EMAIL
		$this->addElement(
                 'ValidationTextBox',   
                 'user_name',   
		array(
                  'value'      => '',  
                  'label'      => '昵称 : ',  
                  'trim'       => true,  
                  'lowercase'  => true,  
                  'required'   => true,  
                  'regExp'     => '^.{4,}$',  
                  'invalidMessage' => '清写一个昵称',  
                  'validators' => array(  
						array('StringLength', false, 4)
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
           		'label'          => '输入密码 : ',  
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
           		'label'          => '确认密码 : ',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{4,}$',  
           		'invalidMessage' => '两次输入密码不同',  
        		'validator'  =>  "return this.getValue() == dijit.byId('password1').getValue()"
			)
		);
			
		$this->addElement(new Zend_Form_Element_Captcha(
			'captcha', array(				
			'label'   => '输入验证码 : ',		
			'captcha' => array(
				'captcha' => 'Image',
				'wordLen' => 6,
				'timeout' => 300,
				'imgUrl' => '/images/captcha/',
				'width' => 200,
				'height' => 60,
				'font' => BASE_PATH.'/images/ACTIVA.TTF'))));
		
		$this->addElement(new Zend_Form_Element_Hidden("role",array("value"=>"user")));
							
		// SUBMIT
		$this->addElement(
       		'SubmitButton',   
       		'submit',   
			array(
           		'required'   => false,  
           		'ignore'     => true,  
           		'label'      => '注册',  
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