<?php

class My_Form_AccountAvatar extends Zend_Form {
	public function init() {
		
		$this->setName ( 'Login' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		$this->setAction ( '/my/account/avatar' )->setMethod ( 'post' );
		
		$fileupload = new Zend_Form_Element_File ( 'fileupload' );
		$fileupload->setLabel ( 'Upload an image:' )->setDestination (BASE_PATH. '/images/upload' );
		// ensure only 1 file
		$fileupload->addValidator ( 'Count', false, 1 );
		// limit to 100K
		$fileupload->addValidator ( 'Size', false, 204800 );
		// only JPEG, PNG, and GIFs
		$fileupload->addValidator ( 'Extension', false, 'jpg,png,gif,jpeg' );
		$this->addElement ( $fileupload, 'fileupload' );
		
				// SUBMIT
		$this->addElement ( 'Submit', 'submitUpload', array ('required' => false, 'ignore' => true, 'label' => '上传' ) );
		
		}

}