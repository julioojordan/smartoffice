<?php
class M_Rooms extends CI_Model
{
	function getRoom($email)
	{
		return $this->db->query("SELECT * FROM rooms WHERE owner='$email'")->row_array();
		
    }

}