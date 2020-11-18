<?php
class M_login extends CI_Model
{
	function auth($email, $password)
	{
		$query = $this->db->query("SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1");
		return $query;
    }
    
    function update_status($email, $password, $status1, $time)
	{
		$this->db->query("UPDATE user SET status1 = $status1, last_login_time = '$time' WHERE email = '$email' and password = '$password'");
	}

	function update_status_off($email)
	{
		$this->db->query("UPDATE user SET status1 = 0 WHERE email = '$email'");
	}

	function auth_server($id, $password)
	{
		$query = $this->db->query("SELECT * FROM server_account WHERE id='$id' AND password='$password' LIMIT 1");
		return $query;
	}

	function server_on($id, $password)
	{
		$this->db->query("UPDATE server_account SET status = 1 WHERE id = '$id' and password = '$password'");
	}

}