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
		$query=  $this->db->query("SELECT * FROM user WHERE user_id ='$id'");
		return $query;
	}
	

	function checkEmail($email, $id)
	{
		return $this->db->query("SELECT * FROM user WHERE email ='$email' AND user_id <> '$id'");
	}

	function checkUser($id, $password)
	{
		return $this->db->query("SELECT * FROM user WHERE user_id ='$id' AND password ='$password'");
	}

	function updateUser($id, $email, $name)
	{
		$this->db->query("UPDATE user SET email ='$email', name='$name' WHERE user_id ='$id'");
		$this->db->query("INSERT INTO rooms(owner, name) VALUES('$email', '$name')");
	}

	function updateUser1($id, $email, $name, $room_id)
	{
		$this->db->query("UPDATE user SET email ='$email', name='$name' WHERE user_id ='$id'");
		$this->db->query("UPDATE rooms SET owner='$email', name='$name' WHERE room_id = '$room_id'");
	}

	function updatePasswordUser($id, $password)
	{
		$this->db->query("UPDATE user SET password ='$password' WHERE user_id ='$id'");
	}
}