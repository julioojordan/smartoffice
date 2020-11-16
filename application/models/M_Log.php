<?php
class M_Log extends CI_Model
{
	function addLogLamp($device_id, $time, $room_id, $user, $status)
	{
        if($status == 1){
            $this->db->query("INSERT INTO log (device_id, time, room_id, user, status) VALUES ('$device_id', '$time', '$room_id', '$user', $status)");
        }else{
            $this->db->query("INSERT INTO log (device_id, time, room_id, user, status) VALUES ('$device_id', '$time', '$room_id', '$user', $status)");
        }
		
    }

}