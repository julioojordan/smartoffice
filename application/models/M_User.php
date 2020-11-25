<?php
class M_User extends CI_Model
{
	function checkStatus($status1)
	{
		return $this->db->query("SELECT * FROM user WHERE status1 ='$status1'")->result_array();
    }
    
    function updateStatus1User($email)
	{
		$this->db->query("UPDATE user SET status1 = 1 WHERE email ='$email'");
	}
	
	//when user clicking a device button or menu button in website
	function updateStatus1User1($email, $time)
	{
		$this->db->query("UPDATE user SET status1 = 2, last_login_time = '$time' WHERE email ='$email'");
	}
	
	//chekcing data user from their id
	function getDataUser($id)
	{
		$query=  $this->db->query("SELECT * FROM user WHERE user_id =$id");
		return $query;
    }
}