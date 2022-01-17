<?php
class M_login extends CI_Model
{
	function auth($email, $password)
	{
		$query = $this->db->query("SELECT * FROM user WHERE (email='$email' OR user_id='$email') AND password='$password' LIMIT 1");
		return $query;
    }
    
    function update_status($email, $password, $status1, $time)
	{
		$this->db->query("UPDATE user SET status1 = $status1, last_login_time = '$time' WHERE (email = '$email' OR user_id = '$email') and password = '$password'");
	}

	function update_status_off($user_id)
	{
		$this->db->query("UPDATE user SET status1 = 0 WHERE user_id = '$user_id'");
	}

	function auth_admin($id, $password)
	{
		$query = $this->db->query("SELECT * FROM user_admin WHERE id='$id' AND password='$password' LIMIT 1");
		return $query;
    }

}