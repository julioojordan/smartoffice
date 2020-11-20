<?php
class M_Rooms extends CI_Model
{
	function getRoom($email)
	{
		return $this->db->query("SELECT * FROM rooms WHERE owner='$email'")->row_array();
		
	}
	
	function getRoom1($room_id)
	{
		return $this->db->query("SELECT * FROM rooms WHERE room_id='$room_id'")->row_array();
		
	}
	
	function getAllRooms($email)
	{
		return $this->db->query("SELECT * FROM rooms
		JOIN user ON rooms.owner = user.email WHERE owner<>'$email' ORDER BY user.status1 DESC, rooms.room_id ASC")->result_array();
		
	}

	//for auto
	function getAllRooms1($email)
	{
		return $this->db->query("SELECT * FROM rooms 
		JOIN user ON rooms.owner = user.email WHERE owner<>'$email' ORDER BY user.status1 DESC, rooms.room_id ASC")->result();
		
	}
	
	function searchRoom($keyword, $email)
	{
		$query = $this->db->query("SELECT * FROM rooms JOIN user ON rooms.owner = user.email WHERE (room_id = '$keyword' OR user.name LIKE '%$keyword%') AND owner<>'$email' ORDER BY user.status1 DESC, rooms.room_id ASC");
		return $query;
		
    }

}