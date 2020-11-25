<?php
class M_Token extends CI_Model
{
	function addToken($token, $room_id, $requester_email)
	{
		$this->db->query("INSERT INTO token (token, room_id, user_email)
        VALUES ('$token', $room_id, '$requester_email')");
    }
}