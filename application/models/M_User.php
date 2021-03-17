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
    
    function updateStatus1User($id)
	{
		$this->db->query("UPDATE user SET status1 = 1, status2 = 0 WHERE user_id ='$id'");
	}

	function updateStatus1User2($id)
	{
		$this->db->query("UPDATE user SET status1 = 0 WHERE user_id ='$id'");
	}
	
	//when user clicking a device button or menu button in website
	function updateStatus1User1($id, $time)
	{
		$this->db->query("UPDATE user SET status1 = 2, last_login_time = '$time' WHERE user_id ='$id'");
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
		JOIN rooms ON user.user_id = rooms.owner
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
		$this->db->query("INSERT INTO rooms(room_type, owner, name) VALUES('$room_type', '$id', '$name')");
	}

	function updateUser1($id, $email, $name, $room_id)
	{
		$this->db->query("UPDATE user SET email ='$email', name='$name' WHERE user_id ='$id'");
	}

	function updatePasswordUser($id, $password)
	{
		$this->db->query("UPDATE user SET password ='$password' WHERE user_id ='$id'");
	}

	function updateAutomation($user_id, $status)
	{
		$this->db->query("UPDATE user SET automation = $status WHERE user_id ='$user_id'");
	}

	function setTimer($user_id, $timer)
	{
		$this->db->query("UPDATE user SET automation_timer = $timer WHERE user_id ='$user_id'");
	}

	function addUser($user_id, $room_type, $password)
	{
		$this->db->query("INSERT INTO user(user_id, room_type, password) VALUES('$user_id', '$room_type', '$password')");
	}

	function getAllUser()
	{
		return $this->db->query("SELECT * FROM user");
	}

	function getUserStatus($status)
	{
		return $this->db->query("SELECT * FROM user WHERE status1 = $status");
	}
}