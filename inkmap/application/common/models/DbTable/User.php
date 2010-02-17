<?php
class Common_Model_DbTable_User extends Zend_Db_Table_Abstract {
	protected $_name = 'users';
	
	public function getUser($id) {
		$id = ( int ) $id;
		$row = $this->fetchRow ( 'id = ' . $id );
		if (! $row) {
			throw new Exception ( "无此用户！" );
		}
		return $row;
	}
	
	public function getUserByEmail($email) {
		$row = $this->fetchRow ( $this->select ()->where ( 'email = ?', $email ) );
		if (! $row) {
			throw new Exception ( "无此用户！" );
		}
		return $row;
	}
	
	public function createUser($email, $user_name, $password, $role) {
		$row = $this->fetchRow ( $this->select ()->where ( 'email = ?', $email ) );
		if (! $row) {
			// create a new row
			$rowUser = $this->createRow ();
			if ($rowUser) {
				// update the row values
				$salt = substr ( md5 ( RAND () ), 0, 20 );
				$rowUser->email = $email;
				$rowUser->password = md5 ( $password . $salt );
				$rowUser->salt = $salt;
				$rowUser->user_name = $user_name;
				$rowUser->role = $role;
				$rowUser->save ();
				//return the new user
				return $rowUser;
			} else {
				throw new Zend_Exception ( "出错啦，请重试！" );
			}
		} else {
			throw new Zend_Exception ( "该用户已存在！" );
		}
	
	}
	
	public function updateAvatar($id, $path) {
		$id = ( int ) $id;
		$row = $this->fetchRow ( 'id = ' . $id );
		if (! $row) {
			throw new Exception ( "无此用户！" );
		}
		$row->avatar = $path;
		$row->save ();
		return $row;
	}
	
	/*
	 * update the information
	 * */
	public function updateInfo($id, $cell, $city, $gender, $age, $introduction, $website, $subscribe, $im_account) {
		$row = $this->fetchRow ( 'id = ' . $id );
		if (! $row) {
			throw new Exception ( "无此用户！" );
		}
		$row->cell = $cell;
		$row->city = $city;
		if ($gender == null || $gender=="none") {
			$row->gender = null;
		} else if ($gender == "male") {
			$row->gender = true;
		} else {
			$row->gender = false;
		}
		$row->age = $age;
		$row->introduction = $introduction;
		$row->website = $website;
		if ($subscribe == "true") {
			$row->subscribe = true;
		}
		else{
			$row->subscribe = false;
		}
		$row->im_account = $im_account;
		$row->save ();
		return $row;
	}
	
	/*
	 * update the password
	 * */
	public function updatePass($id, $salt, $password) {
		$pass = md5 ( $password . $salt );
		$row = $this->fetchRow ( 'id = ' . $id );
		if (! $row) {
			throw new Exception ( "无此用户！" );
		}
		$row->password = $pass;
		$row->save ();
		return $row;
	}
	
	/*
	 * validate the password
	 * */
	public function validatePass($id, $salt, $password) {
		$id = ( int ) $id;
		$pass = md5 ( $password . $salt );
		$row = $this->fetchRow ( 'id =' . $id . ' and password="' . $pass . '"' );
		if (! $row) {
			return false;
		} else {
			return true;
		}
	}
}
