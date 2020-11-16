<?php
class M_Messages extends CI_Model
{
	function checkMessage($email, $status)
	{
		return $this->db->query("SELECT * FROM messages WHERE u_from ='$email' AND message = $status")->num_rows();
		
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


}