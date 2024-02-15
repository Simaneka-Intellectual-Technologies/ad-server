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
	public function update_clicks($id)
	{
		$this->db->where('ad_id', $id);
		$this->db->set('clicks', '`clicks`+ 1', FALSE);
		$this->db->update('ads');

		$where = array(
			'ad_id' => $id
		);

		return $this->db->get_where('ads', $where)->row_array();
	}
	public function update_impressions($table, $data)
	{
		return $this->db->get_where($table, $data)->result_array();
	}
	public function get_ad($type)
	{
		$where = array(
			'type' => $type,
			'status' => 1,
			'start_date <=', date('Y-m-d'),
			'end_date >=', date('Y-m-d')
		);

		return $this->db->get_where('ads', $where)->row_array();
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
