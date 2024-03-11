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
}
