<?php
class M_login extends CI_Model
{
	function auth($email, $password)
	{
		$query = $this->db->query("SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1");
		return $query;
    }
    
    function update_status($email, $password)
	{
		$this->db->query("UPDATE user SET status1 = 1 WHERE email = '$email' and password = '$password'");
	}

}