<?php
class Main_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function get_where($table, $data)
	{
		return $this->db->get_where($table, $data)->result_array();
	}
	public function buildRandomString()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 16; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}

		return $randomString;
	}
}
