<?php
class M_Rooms extends CI_Model
{
	function getRoom($user_id)
	{
		return $this->db->query("SELECT * FROM rooms WHERE owner='$user_id'")->row_array();
		
	}
	
	function getRoom1($room_id)
	{
		return $this->db->query("SELECT * FROM rooms WHERE room_id='$room_id'")->row_array();
		
	}
	
	function getAllRooms($user_id)
	{
		return $this->db->query("SELECT * FROM rooms
		JOIN user ON rooms.owner = user.user_id WHERE owner<>'$user_id' ORDER BY user.status1 DESC, rooms.room_id ASC")->result_array();
		
	}

	//for auto
	function getAllRooms1($user_id)
	{
		return $this->db->query("SELECT * FROM rooms 
		JOIN user ON rooms.owner = user.user_id WHERE owner<>'$user_id' ORDER BY user.status1 DESC, rooms.room_id ASC")->result();
		
	}
	
	function searchRoom($keyword, $user_id)
	{
		$query = $this->db->query("SELECT * FROM rooms JOIN user ON rooms.owner = user.user_id WHERE (room_id = '$keyword' OR user.name LIKE '%$keyword%') AND owner<>'$user_id' ORDER BY user.status1 DESC, rooms.room_id ASC");
		return $query;
		
	}
	
	function getAllRooms2()
	{
		return $this->db->query("SELECT * FROM rooms ORDER BY room_id ASC ")->result_array();
	}

	function getAllType()
	{
		return $this->db->query("SELECT * FROM room_type");
	}

}