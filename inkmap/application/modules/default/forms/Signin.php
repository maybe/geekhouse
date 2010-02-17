<?php

class  Form_Signin extends Zend_Form
{
	public function init()
	{
		$this->setName('login');
		$this->setAction('/lgn/signin')
		->setMethod('post');
			
		// EMAIL
		$this->addElement(
                 'Text',   
                 'email',   
		array(
                  'value'      => '',  
                  'label'      => '电子邮箱 : ',  
                  'trim'       => true,  
                  'lowercase'  => true,  
                  'required'   => true,  
                  'regExp'     => '^.{6,}$',  
                  'validators' => array(  
                        'EmailAddress',  
						array('StringLength', false, 6)
				  ),
                  'filters'  => array('StringToLower'),  
		)
		);
			
			
		// PASSWORD
		$this->addElement(
       		'Password',   
       		'password',   
			array(
           		'label'          => '密码 : ',  
           		'required'       => true,  
           		'trim'           => true,  
           		'regExp'         => '^.{6,}$',  
        		'validators'  => array(array('StringLength', false, 6))
			)
		);
			
		// SUBMIT
		$this->addElement(
       		'Submit',   
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