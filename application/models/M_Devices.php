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

}