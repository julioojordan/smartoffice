<?php
class M_Microcontroller extends CI_Model
{   

    function getUserInfo($user_id){
		  return $this->db->query("SELECT * FROM user WHERE user_id = '$user_id'");
    }

    function getUserDevices($user_id){
		return $this->db->query("SELECT * FROM user 
        JOIN rooms ON user.user_id = rooms.owner
        WHERE user_id = '$user_id'")->row_array();
    }

    function setUserStatus($user_id, $status){
      $this->db->query("UPDATE user SET status2 = '$status' WHERE user_id = '$user_id'");
    }
    
    function getLockStatus($room_id){
		return $this->db->query("SELECT * FROM devices WHERE room_id = '$room_id' AND type = 1");
    }
    
    function setLockStatus($room_id){
		$this->db->query("UPDATE devices SET status = 0 WHERE room_id = '$room_id' AND type = 1");
    }
    
    function getDevicesStatus($room_id){
        return $this->db->query("SELECT * FROM devices WHERE room_id = '$room_id' ORDER BY type ASC")->result();
    }

}