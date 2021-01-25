<?php
class M_User extends CI_Model
{
	function checkStatus($status1)
	{
		return $this->db->query("SELECT * FROM user WHERE status1 ='$status1'")->result_array();
	}
	
	function checkStatus1($automation)
	{
		return $this->db->query("SELECT * FROM user WHERE automation ='$automation'")->result_array();
    }
    
    function updateStatus1User($email)
	{
		$this->db->query("UPDATE user SET status1 = 1, status2 = 'Not In The Room' WHERE email ='$email'");
	}

	function updateStatus1User2($email)
	{
		$this->db->query("UPDATE user SET status1 = 0 WHERE email ='$email'");
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

	function getUserRoom($id)
	{
		$query=  $this->db->query("SELECT * FROM user 
		JOIN rooms ON user.email = rooms.owner
		WHERE user_id ='$id'");
		return $query;
	}

	//updated user device status
	function updateDeviceUser($room_id, $status)
	{
		$this->db->query("UPDATE devices set status = $status WHERE room_id ='$room_id' AND type <> 1");
	}
	

	function checkEmail($email, $id)
	{
		return $this->db->query("SELECT * FROM user WHERE email ='$email' AND user_id <> '$id'");
	}

	function checkUser($id, $password)
	{
		return $this->db->query("SELECT * FROM user WHERE user_id ='$id' AND password ='$password'");
	}

	function updateUser($id, $email, $name, $room_type)
	{
		$this->db->query("UPDATE user SET email ='$email', name='$name' WHERE user_id ='$id'");
		$this->db->query("INSERT INTO rooms(room_type, owner, name) VALUES('$room_type', '$email', '$name')");
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

	function updateAutomation($email, $status)
	{
		$this->db->query("UPDATE user SET automation = $status WHERE email ='$email'");
	}

	function setTimer($user_id, $timer)
	{
		$this->db->query("UPDATE user SET automation_timer = $timer WHERE user_id ='$user_id'");
	}
}