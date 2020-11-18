<?php
class M_User extends CI_Model
{
	function checkStatus($status1)
	{
		return $this->db->query("SELECT * FROM user WHERE status1 ='$status1'")->result_array();
    }
    
    function updateStatus1User($email)
	{
		$this->db->query("UPDATE user SET status1 = 2 WHERE email ='$email'");
    }
}