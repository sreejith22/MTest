<?php 

class Model_subscribers extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUserData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM users_subscription WHERE subscription_id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users_subscription
    LEFT JOIN users ON users_subscription.user_id=users.id
     WHERE subscription_id != '' ORDER BY subscription_id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getUserGroup($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM user_group WHERE user_id = ?";
			$query = $this->db->query($sql, array($userId));
			$result = $query->row_array();

			$group_id = $result['group_id'];
			$g_sql = "SELECT * FROM groups WHERE id = ?";
			$g_query = $this->db->query($g_sql, array($group_id));
			$q_result = $g_query->row_array();
			return $q_result;
		}
	}

	public function create($data = '')
	{

		if($data) {
			$create = $this->db->insert('users', $data);

			$user_id = $this->db->insert_id();
			return ($create == true) ? true : false;
		}
	}

	public function edit($data = array(), $id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

	
			
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('users');
		return ($delete == true) ? true : false;
	}

	public function countTotalUsers()
	{
		$sql = "SELECT * FROM users WHERE id != ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function getAdminUserData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM admin_users WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM admin_users WHERE id != ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
}