<?php
class Main extends CI_Controller
{
	public function view()
	{
		$this->load->view('landing/home');
	}
	public function accountCreation()
	{
		$reply = $this->main_model->createAccount();

		echo json_encode(
			$reply
		);
	}
	public function verify()
	{
		$id = $this->input->get('id');
		$code = $this->input->get('code');

		$where = array(
			'user_id' => $this->input->get('id'),
			'verfication_code' => $this->input->get('code'),
		);

		$data = array(
			'verfication_code' => '',
			'verified_on' => date('Y-m-d H:i:s'),
			'status' => 1
		);

		$this->admin_model->update('admin', $where, $data);

		$where2 = array(
			'user_id' => $this->input->get('id'),
		);

		$user = $this->admin_model->get_where('admin', $where2, false, null);

		if ($user) {
			$user = $user[0];
			$data = array(
				'last_login' => date('Y-m-d H:i:s')
			);
			$where = array(
				'user_id' => $user['user_id']
			);
			$this->admin_model->update('admin', $where, $data);
			$user_data = array(
				'user_id' => $user['user_id'],
				'comp_id' => $user['comp_id'],
				'email' => $user['email'],
				'name' => $user['name'] . ' ' . $user['surname'],
				'last_login' => $user['last_login'],
				'type' => $user['type'],
				'image' => $user['image'],
				'logged_in' => true
			);
			$this->session->set_userdata($user_data);
			header('Location: ' . base_url('admin/page/ads'));
		}
	}
}