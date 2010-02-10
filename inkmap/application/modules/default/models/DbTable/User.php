<?php
class Model_DbTable_User extends Zend_Db_Table_Abstract {
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
}
