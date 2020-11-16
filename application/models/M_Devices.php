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

    function deleteDevice($id)
	{
		$this->db->query("DELETE FROM devices WHERE id = '$id'");
	}

	function updateStatus($id, $status)
	{
		if ($status == 1){
			$this->db->query("UPDATE devices SET status = 1 WHERE id = '$id'");
		}else{
			$this->db->query("UPDATE devices SET status = 0 WHERE id = '$id'");
		}
		
	}

    function getStatus($room_id){
		return $this->db->query("SELECT * FROM devices WHERE room_id ='$room_id' ORDER BY type ASC")->result_array();
	}

}