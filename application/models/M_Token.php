<?php
class M_Token extends CI_Model
{
	function addToken($token, $room_id, $requester_email)
	{
		if ( function_exists( 'date_default_timezone_set' ) ){
    		date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");
		}
		$valid = strtotime($now) + 7200; //in 2 hours the token will expired
        $valid = date('Y-m-d H:i:s', $valid);
		$this->db->query("INSERT INTO token (token, room_id, user_email, status, valid)
        VALUES ('$token', $room_id, '$requester_email', 1, '$valid')");
	}
	
	function checkAccess($room_id, $email, $status)
	{
		return $this->db->query("SELECT * FROM token WHERE room_id = '$room_id' AND user_email = '$email' AND status = '$status' ");
	}

	function getGuest($room_id, $status)
	{
		return $this->db->query("SELECT * FROM token 
		JOIN user ON token.user_email = user.email
		WHERE room_id = '$room_id' AND status = $status ");
	}

	function getAccess($user_email, $status)
	{
		return $this->db->query("SELECT * FROM token 
		JOIN rooms ON token.room_id = rooms.room_id
		JOIN user ON rooms.owner = user.email
		WHERE user_email = '$user_email' AND status = $status ");
	}

	function getToken($token)
	{
		return $this->db->query("SELECT * FROM token WHERE token = '$token' ");
	}

	//for server
	function checkTokenStatus($status)
	{
		return $this->db->query("SELECT * FROM token WHERE status ='$status'")->result_array();
	}
	function updateStatusToken($no)
	{
		$this->db->query("UPDATE token SET status = 0 WHERE no ='$no'");
	}
	//end for server
}