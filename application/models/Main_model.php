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
	public function get_ad($type)
	{
		$sql = "SELECT * FROM ads WHERE start_date < CURDATE() AND end_date > CURDATE() AND type = '" . $type ."' AND status = 1 ORDER BY RAND() LIMIT 1";
		$query = $this->db->query($sql);

		$this->db->where('ad_id', $query->row_array()['ad_id']);
		$this->db->set('impressions', '`impressions`+ 1', FALSE);
		$this->db->update('ads');

		return $query->row_array();
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
