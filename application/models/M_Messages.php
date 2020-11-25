<?php
class M_Messages extends CI_Model
{
	function checkMessage($u_to, $email, $status)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_from ='$email' AND message = $status AND u_to ='$u_to'")->num_rows();
		
    }
    
    function getMessage($email, $status)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_from ='$email' AND message = $status ORDER BY time DESC LIMIT 1")->row_array();
		
    }
    
    function sendRequest($u_from, $u_to, $time)
	{
		$this->db->query("INSERT INTO messages (u_from, u_to, message, time)
        VALUES ('$u_from', '$u_to', 1, '$time')");
		
	}
	
    function countUnreplied($email)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_to ='$email' AND reply_status = 0")->num_rows();
		
    }

    function getUnrepliedLast($email)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_to ='$email' AND reply_status = 0 ORDER BY time DESC LIMIT 1")->result();
		
	}
	
	function getUnreplied($email, $message, $reply_status)
	{
		$query = $this->db->query("SELECT * FROM messages 
		JOIN user ON messages.u_from = user.email
		WHERE u_to ='$email' AND reply_status = '$reply_status' AND message = '$message' ORDER BY time DESC");
		return $query;
	}
	
	function updateUnreplied($id, $message, $reply_status)
	{
		$this->db->query("UPDATE messages SET message= $message, reply_status = $reply_status WHERE id ='$id' ");
	}

	function updateGranted($id, $message, $reply_status)
	{
		$this->db->query("UPDATE messages SET message= $message, reply_status = $reply_status WHERE id ='$id'");
	}
	
	function searchMessages($keyword, $email, $message, $reply_status)
	{
		$query = $this->db->query("SELECT * FROM messages 
		JOIN user ON messages.u_from = user.email
		WHERE (u_from LIKE '%$keyword%' OR user.name LIKE '%$keyword%') AND (u_to ='$email' AND reply_status = '$reply_status' AND message = '$message') ORDER BY time DESC");
		return $query;
		
	}


}