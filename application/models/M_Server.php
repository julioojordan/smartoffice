<?php
class M_Server extends CI_Model
{

	function auth($id, $password)
	{
		$query = $this->db->query("SELECT * FROM server_account WHERE id='$id' AND password='$password' LIMIT 1");
		return $query;
	}

	function server_on($id, $password)
	{
		$this->db->query("UPDATE server_account SET status = 1 WHERE id = '$id' and password = '$password'");
    }

    function server_off($id)
	{
		$this->db->query("UPDATE server_account SET status = 0 WHERE id = '$id'");
    }
    
    function getOnServer()
	{
		$query = $this->db->query("SELECT * FROM server_account WHERE status=1 LIMIT 1");
		return $query;
	}

}