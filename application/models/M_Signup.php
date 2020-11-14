<?php
class M_signup extends CI_Model
{
	function check_email($email)
	{
		$query = $this->db->query("SELECT * FROM user WHERE email='$email' LIMIT 1");
		return $query;
    }
    
    function add_user($name, $email, $password)
	{
		$this->db->query("INSERT INTO user (name, email, password, status1, status2)
        VALUES ('$name', '$email', '$password', 0, 'Not In The Room')");
	}

}