<?php
class Model_DbTable_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';
	public function getUser($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
		if (!$row) {
			throw new Exception("Count not find row $id");
		}
		return $row->toArray();
	}

	public function createUser($username, $password, $firstName, $lastName, $role)
	{
		// create a new row
		$rowUser = $this->createRow();
		if($rowUser) {
			// update the row values
			$rowUser->username = $username;
			$rowUser->password = md5($password);
			$rowUser->first_name = $firstName;
			$rowUser->last_name = $lastName;
			$rowUser->role = $role;
			$rowUser->save();
			//return the new user
			return $rowUser;
		} else {
			throw new Zend_Exception("Could not create user!");
		}
	}

}
