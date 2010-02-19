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
	protected $_auth;
	protected $_identity;
	
	/*
	 * init method
	 * */
	public function init() {
		$this->auth = Zend_Auth::getInstance ();
		if (! $this->auth->hasIdentity ()) {
			$this->_redirect ( "/" );
		}
		$this->identity = $this->auth->getIdentity ();
	}
	
	public function indexAction() {
	
	}
	
	/*
	 * settings
	 * */
	public function settingsAction() {
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$count = $_POST ["imCount"];
			$im_account = null;
			if ($count != null && $count != 0) {
				$doc = new DOMDocument ();
				$doc->formatOutput = true;
				$r = $doc->createElement ( "im" );
				$doc->appendChild ( $r );
				for($i = 1; $i <= $count; $i ++) {
					$b = $doc->createElement ( "imItem" );
					$type = $doc->createElement ( "imType" );
					$type->appendChild ( $doc->createTextNode ( $_POST ["imType" . $i] ) );
					$account = $doc->createElement ( "imAccount" );
					$account->appendChild ( $doc->createTextNode ( $_POST ["imValue" . $i] ) );
					$b->appendChild ( $type );
					$b->appendChild ( $account );
					$r->appendChild ( $b );
				}
				$im_account = $doc->saveXML ();
			}
			$cell = $_POST ["cell"];
			$city = $_POST ["city"];
			$gender = $_POST ["gender"];
			$age = $_POST ["age"];
			$introduction = $_POST ["introduction"];
			$website = $_POST ["website"];
			$subscribe = $_POST ["subscribe"];
			$id = $this->identity->id;
			$user = new Common_Model_DbTable_User ();
			$returnValue = $user->updateInfo ( $id, $cell, $city, $gender, $age, $introduction, $website, $subscribe, $im_account );
			$this->identity->cell = $returnValue->cell;
			$this->identity->city = $returnValue->city;
			$this->identity->gender = $returnValue->gender;
			$this->identity->age = $returnValue->age;
			$this->identity->introduction = $returnValue->introduction;
			$this->identity->website = $returnValue->website;
			$this->identity->im_account = $returnValue->im_account;
			$this->identity->subscribe = $returnValue->subscribe;
		}
		$this->view->cell = $this->identity->cell;
		$this->view->city = $this->identity->city;
		$this->view->gender = $this->identity->gender;
		$this->view->age = $this->identity->age;
		$this->view->introduction = $this->identity->introduction;
		$this->view->website = $this->identity->website;
		$this->view->subscribe = $this->identity->subscribe;
		$im = $this->identity->im_account;
		if ($im != null) {
			$imArray = array ();
			$doc = new DOMDocument ();
			$doc->loadXML ( $im );
			$imItems = $doc->getElementsByTagName ( "imItem" );
			foreach ( $imItems as $imItem ) {
				$types = $imItem->getElementsByTagName ( "imType" );
				$type = $types->item ( 0 )->nodeValue;
				$accounts = $imItem->getElementsByTagName ( "imAccount" );
				$account = $accounts->item ( 0 )->nodeValue;
				$tmp = array ($type, $account );
				array_push ( $imArray, $tmp );
			}
			$this->view->im = $imArray;
		}
	}
	
	/*
	 * change the head picture
	 * */
	public function avatarAction() {
		//		$adapter = new Common_Model_DbTable_User ();
		//		$getUser = $adapter->getUser ( $this->identity->id );
		$this->view->avatar = $this->identity->avatar;
		
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
						$nameFile = '/images/upload/' . sha1 ( rand () ) . '.jpg';
						$fullPathNameFile = BASE_PATH . $nameFile;
						
						$locationFile = $avataForm->fileupload->getFileName ();
						$image = new InkMap_Assist_SimpleImage ();
						$image->load ( $locationFile );
						$image->resizeToWidth ( 400 );
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
				
				$nameFile = $_POST ["fileName"];
				$fullPathNameFile = BASE_PATH . $nameFile;
				
				$src = $fullPathNameFile;
				$img_r = imagecreatefromjpeg ( $src );
				$dst_r = ImageCreateTrueColor ( $targ_w, $targ_h );
				
				imagecopyresampled ( $dst_r, $img_r, 0, 0, $_POST ['x'], $_POST ['y'], $targ_w, $targ_h, $_POST ['w'], $_POST ['h'] );
				$image = '/images/user_avatar/' . sha1 ( rand () ) . '.jpg';
				$imageFullPath = BASE_PATH . $image;
				imagejpeg ( $dst_r, $imageFullPath, $jpeg_quality );
				imagedestroy ( $dst_r );
				
				$user = new Common_Model_DbTable_User ();
				if ($this->identity->avatar!=null) {
					unlink ( BASE_PATH . $this->identity->avatar );
				}
				$user->updateAvatar ( $this->identity->id, $image );
				$this->identity->avatar = $image;
				$this->view->avatar = $this->identity->avatar;
				
				if (file_exists ( $fullPathNameFile )) {
					unlink ( $fullPathNameFile );
				}
			}
		
		}
	
	}
	
	/*
	 * change the password
	 * */
	public function passwordAction() {
		$this->view->changeMessage = "";
		$passForm = new My_Form_AccountPassword ();
		$this->view->passForm = $passForm;
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			if ($passForm->isValid ( $_POST )) {
				$data = $passForm->getValues ();
				$id = $this->identity->id;
				$salt = $this->identity->salt;
				$user = new Common_Model_DbTable_User ();
				if (! $user->validatePass ( $id, $salt, $data ['password1'] )) {
					$this->view->changeMessage = "密码错误鸟～";
				} else {
					$user->updatePass ( $id, $salt, $data ['password2'] );
					$this->view->changeMessage = "密码修改成功鸟～";
				}
			}
		}
	}
	
	/*
	 * orders
	 * */
	public function ordersAction() {
	
	}
	
	/*
	 * address
	 * */
	public function addressAction() {
	
	}
	
}