<?php
class M_Devices extends CI_Model
{
	function getDevice($email)
	{
		return $this->db->query("SELECT * FROM devices 
        JOIN rooms ON devices.room_id = rooms.room_id
        JOIN device_types ON devices.type = device_types.id
        WHERE rooms.owner='$email'")->result_array();
		
	}
	
	function getGuestDevice($token)
	{
		return $this->db->query("SELECT * FROM devices 
        JOIN rooms ON devices.room_id = rooms.room_id
        JOIN device_types ON devices.type = device_types.id
        WHERE devices.room_id = (SELECT room_id FROM token WHERE token = '$token')")->result_array();
		
	}

    function deleteDevice($id)
	{
		$this->db->query("DELETE FROM devices WHERE device_id = '$id'");
	}

	function updateStatus($id, $status)
	{
		if ($status == 1){
			$this->db->query("UPDATE devices SET status = 1 WHERE device_id = '$id'");
		}else{
			$this->db->query("UPDATE devices SET status = 0 WHERE device_id = '$id'");
		}
		
	}

	function updateStatusLock($id)
	{
		$this->db->query("UPDATE devices SET status = status + 1 WHERE device_id = '$id'");
		
	}

    function getStatus($room_id){
		return $this->db->query("SELECT * FROM devices WHERE room_id ='$room_id' ORDER BY type ASC")->result_array();
	}

	function guestDevice($id, $status)
	{
		$this->db->query("UPDATE devices SET guest = $status WHERE device_id = '$id'");
		
	}


}