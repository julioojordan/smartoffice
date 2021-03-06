<?php
class M_Devices extends CI_Model
{
	function getDevice($id)
	{
		return $this->db->query("SELECT * FROM devices 
        JOIN rooms ON devices.room_id = rooms.room_id
        JOIN device_types ON devices.type = device_types.id
        WHERE rooms.owner='$id'")->result_array();
		
	}
	
	function getGuestDevice($token)
	{
		return $this->db->query("SELECT * FROM devices 
        JOIN rooms ON devices.room_id = rooms.room_id
        JOIN device_types ON devices.type = device_types.id
        WHERE devices.room_id = (SELECT room_id FROM token WHERE token = '$token') AND devices.guest = 1")->result_array();
		
	}

    function deleteDevice($id)
	{
		$this->db->query("DELETE FROM devices WHERE device_id = '$id'");
	}

	function updateStatus($id, $status)
	{
		$this->db->query("UPDATE devices SET status = $status WHERE device_id = '$id'");
		
	}

	function updateStatusLock($id)
	{
		$this->db->query("UPDATE devices SET status = status + 1 WHERE device_id = '$id'");
		
	}

    function getStatus($room_id){
		return $this->db->query("SELECT * FROM devices WHERE room_id ='$room_id' ORDER BY type ASC")->result_array();
	}

	//for dashboard
	function getStatus1($room_id){
		return $this->db->query("SELECT * FROM devices WHERE room_id ='$room_id' ORDER BY type ASC")->result();
	}

	//for guest
	function getStatus2($room_id){
		return $this->db->query("SELECT * FROM devices WHERE room_id ='$room_id' AND guest = 1 ORDER BY type ASC")->result();
	}

	function guestDevice($id, $status)
	{
		$this->db->query("UPDATE devices SET guest = $status WHERE device_id = '$id'");
		
	}

	function addDevice($room_id, $room_type)
	{
		if ($room_type == 'R1'){ //Normal Room
			$this->db->query("INSERT INTO devices(type, device_name, room_id, status) VALUES('1', 'lock', '$room_id', 0), ('2', 'lamp', '$room_id', 0), ('3', 'fan', '$room_id', 0)");
		}elseif ($room_type == 'R2'){ // Exclusive Room
			$this->db->query("INSERT INTO devices(type, device_name, room_id, status) VALUES('1', 'lock', '$room_id', 0), ('2', 'lamp', '$room_id', 0), ('2', 'lamp', '$room_id', 0), ('3', 'fan', '$room_id', 0), ('3', 'fan', '$room_id', 0)");
		}elseif ($room_type == 'H1'){// Super Room
			$this->db->query("INSERT INTO devices(type, device_name, room_id, status) VALUES('1', 'lock', '$room_id', 0), ('2', 'lamp', '$room_id', 0), ('2', 'lamp', '$room_id', 0), ('2', 'lamp', '$room_id', 0), ('3', 'fan', '$room_id', 0), ('3', 'fan', '$room_id', 0), ('3', 'fan', '$room_id', 0)");
		}
		
	}


}