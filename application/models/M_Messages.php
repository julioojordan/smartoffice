<?php
class M_Messages extends CI_Model
{
	function checkMessage($u_to, $u_from, $status)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_from ='$u_from' AND message = $status AND u_to ='$u_to'")->num_rows();
		
    }
    
    function getMessage($u_from, $status)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_from ='$u_from' AND message = $status ORDER BY time DESC LIMIT 1")->row_array();
		
    }
    
    function sendRequest($u_from, $u_to, $time)
	{
		$this->db->query("INSERT INTO messages (u_from, u_to, message, time)
        VALUES ('$u_from', '$u_to', 1, '$time')");
		
	}
	
    function countUnreplied($u_to)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_to ='$u_to' AND reply_status = 0")->num_rows();
		
    }

    function getUnrepliedLast($u_to)
	{
		return $this->db->query("SELECT * FROM messages
		JOIN user ON messages.u_from = user.user_id
		WHERE u_to ='$u_to' AND reply_status = 0 ORDER BY time DESC LIMIT 1")->result();
		
	}
	
	function getUnreplied($u_to, $message, $reply_status)
	{
		$query = $this->db->query("SELECT * FROM messages 
		JOIN user ON messages.u_from = user.user_id
		WHERE u_to ='$u_to' AND reply_status = '$reply_status' AND message = '$message' ORDER BY time DESC");
		return $query;
	}

	function getUnrepliedServer()
	{
		$query = $this->db->query("SELECT * FROM messages WHERE reply_status = 0 AND message = 1 ORDER BY time DESC");
		return $query;
	}

	//access request
	function getUnrepliedRequest($u_from, $message, $reply_status)
	{
		$query = $this->db->query("SELECT * FROM messages 
		JOIN user ON messages.u_from = user.user_id
		WHERE u_from ='$u_from' AND reply_status = '$reply_status' AND message = '$message' ORDER BY time DESC");
		return $query;
	}

	function getReplied($u_to, $reply_status)
	{
		$query = $this->db->query("SELECT * FROM messages 
		JOIN user ON messages.u_from = user.user_id
		WHERE u_to ='$u_to' AND reply_status = '$reply_status' ORDER BY time DESC LIMIT 10");
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

	function updateDeclined($id, $message, $reply_status)
	{
		$this->db->query("UPDATE messages SET message= $message, reply_status = $reply_status WHERE id ='$id'");
	}
	
	function searchMessages($keyword, $u_to, $message, $reply_status)
	{
		$query = $this->db->query("SELECT * FROM messages 
		JOIN user ON messages.u_from = user.user_id
		WHERE (u_from LIKE '%$keyword%' OR user.name LIKE '%$keyword%') AND (u_to ='$u_to' AND reply_status = '$reply_status' AND message = '$message') ORDER BY time DESC");
		return $query;
		
	}


}