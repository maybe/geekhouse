<?php

/**
 * AccountController
 * 
 * @Sean
 * @version 1.0 
 */

require_once 'Zend/Controller/Action.php';

class My_AccountController extends Zend_Controller_Action {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
	}
	
	public function settingsAction() {
	
	}
	
	/*
	 * change the head picture
	 * */
	public function avatarAction() {
		$adapter = new Model_DbTable_User ();
		$getUser = $adapter->getUserById ();
		$salt = $getUser->salt;
		
		$this->view->ifUpload = false;
		$avataForm = new My_Form_AccountAvatar ();
		$this->view->avatarForm = $avataForm;
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			if ($_POST ["submitUpload"] != null) {
				if ($avataForm->isValid ( $_POST )) {
					// Uploading File
					$nameFile = "";
					if ($avataForm->fileupload->receive ()) {
						$auth = Zend_Auth::getInstance ();
						$identity = $auth->getIdentity ();
						$user_name = $identity->user_name;
						$nameFile = '/images/upload/' . $user_name . '.jpg';
						$fullPathNameFile = BASE_PATH . $nameFile;
						
						$locationFile = $avataForm->fileupload->getFileName ();
						$image = new InkMap_Assist_SimpleImage ();
						$image->load ( $locationFile );
						$image->resizeToWidth ( 300 );
						$image->save ( $fullPathNameFile );
						unlink ( $locationFile );
					}
					//$uploadedData = $avataForm->getValues ();
					$this->view->ifUpload = true;
					$this->view->uploadPhoto = $nameFile;
				
				}
			} else {
				$targ_w = $targ_h = 150;
				$jpeg_quality = 90;
				
				$auth = Zend_Auth::getInstance ();
				$identity = $auth->getIdentity ();
				$user_name = $identity->user_name;
				$nameFile = '/images/upload/' . $user_name . '.jpg';
				$fullPathNameFile = BASE_PATH . $nameFile;
				
				$src = $fullPathNameFile;
				$img_r = imagecreatefromjpeg ( $src );
				$dst_r = ImageCreateTrueColor ( $targ_w, $targ_h );
				
				imagecopyresampled ( $dst_r, $img_r, 0, 0, $_POST ['x'], $_POST ['y'], $targ_w, $targ_h, $_POST ['w'], $_POST ['h'] );
				$image = BASE_PATH . '/images/user_avatar/' . $user_name . '.jpg';
				imagejpeg ( $dst_r, $image, $jpeg_quality );
				imagedestroy ( $dst_r );
				
				$user = new Model_DbTable_User ();
				$getUser = $user->getUserByEmail ();
				$salt = $getUser->salt;
			}
		
		}
	
	}
	
	/*
	 * change the password
	 * */
	public function passwordAction() {
	}

}