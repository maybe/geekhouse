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
	public function addUser($user)
	{
		$data = array(
            'artist' => $user['a'],
            'title' => $title,
		);
		$this->insert($data);
	}
	public function updateUser($id, $artist, $title)
	{
		$data = array(
          'artist' => $artist,
          'title' => $title,
		);
		$this->update($data, 'id = '. (int)$id);
	}
	public function deleteUser($id)
	{
		$this->delete('id =' . (int)$id);
	}
}
