<?php
class Main_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	function record_ad_log($site, $type, $tags, $ad, $message)
	{
		$data = array(
			"company" => $site,
			"ad_type" => $type,
			"tag_requests" => $tags,
			"ad_served" => $ad,
			"message" => $message,
		);

		$this->db->insert("ad_request_logs", $data);
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
	public function get_ad($type, $tags, $site)
	{
		$splitTags = explode(',', $tags);
		$addTags = '';


		// print_r($splitTags);
		// die();
		if (count($splitTags) > 0) {
			foreach ($splitTags as $index => $tag) {
				$addTags .= (($index > 0) ? ' OR' : ' AND (') . " tags LIKE '%" . $tag . "%' ";
			}

			$addTags .= ')';
		}
		$sql = "SELECT * FROM ads WHERE start_date < CURDATE() AND end_date > CURDATE() AND type = '" . $type . "' AND visibility = '" . $site['company_type'] . "' " . $addTags . " AND status = 1 ORDER BY RAND() LIMIT 1";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {

			$this->db->where('ad_id', $query->row_array()['ad_id']);
			$this->db->set('impressions', '`impressions`+ 1', FALSE);
			$this->db->update('ads');

			$message = 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!';
			$ad = $query->row_array()['title'] . ' ' . $query->row_array()['ad_id'] . ' ' . $query->row_array()['file'] . ' ' . $query->row_array()['redirect_link'];
			$this->record_ad_log($site['title'], $type, $tags, $ad, $message);
			return array(
				'status' => true,
				'message' => $message,
				'ad' => $query->row_array()
			);
		}

		$sql = "SELECT * FROM ads WHERE start_date < CURDATE() AND end_date > CURDATE() AND type = '" . $type . "' " . $addTags . " AND status = 1 ORDER BY RAND() LIMIT 1";
		$query = $this->db->query($sql);


		if ($query->num_rows() > 0) {

			$this->db->where('ad_id', $query->row_array()['ad_id']);
			$this->db->set('impressions', '`impressions`+ 1', FALSE);
			$this->db->update('ads');

			$message = 'We did not find a ' . str_replace('_', ' ', $type) . ' advertisment but not on a ' . $site['company_type'] . ' standard and got you another type!';
			$ad = $query->row_array()['title'] . ' ' . $query->row_array()['ad_id'] . ' ' . $query->row_array()['file'] . ' ' . $query->row_array()['redirect_link'];
			$this->record_ad_log($site['title'], $type, $tags, $ad, $message);
			return array(
				'status' => true,
				'message' => $message,
				'ad' => $query->row_array()
			);
		}

		$sql = "SELECT * FROM ads WHERE start_date < CURDATE() AND end_date > CURDATE() " . $addTags . " AND status = 1 ORDER BY RAND() LIMIT 1";
		$query = $this->db->query($sql);


		if ($query->num_rows() > 0) {

			$this->db->where('ad_id', $query->row_array()['ad_id']);
			$this->db->set('impressions', '`impressions`+ 1', FALSE);
			$this->db->update('ads');

			$message = 'We did not find a ' . str_replace('_', ' ', $type) . ' advertisment and got you another type!';
			$ad = $query->row_array()['title'] . ' ' . $query->row_array()['ad_id'] . ' ' . $query->row_array()['file'] . ' ' . $query->row_array()['redirect_link'];
			$this->record_ad_log($site['title'], $type, $tags, $ad, $message);
			return array(
				'status' => true,
				'message' => $message,
				'ad' => $query->row_array()
			);
		}

		$sql = "SELECT * FROM ads WHERE start_date < CURDATE() AND end_date > CURDATE() AND status = 1 ORDER BY RAND() LIMIT 1";
		$query = $this->db->query($sql);


		if ($query->num_rows() > 0) {

			$this->db->where('ad_id', $query->row_array()['ad_id']);
			$this->db->set('impressions', '`impressions`+ 1', FALSE);
			$this->db->update('ads');

			$message = 'We got a random ad!';
			$ad = $query->row_array()['title'] . ' ' . $query->row_array()['ad_id'] . ' ' . $query->row_array()['file'] . ' ' . $query->row_array()['redirect_link'];
			$this->record_ad_log($site['title'], $type, $tags, $ad, $message);
			return array(
				'status' => true,
				'message' => $message,
				'ad' => $query->row_array()
			);
		}
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
	function createAccount()
	{
		$where = array(
			'email' => $this->input->post('email')
		);
		$company = $this->admin_model->get_where('companies', $where, false, null);

		if ($company) {
			return array(
				'status' => false,
				'message' => 'The email you entered is already registered!'
			);
		} else {
			$password = 'Temp' . rand(100, 1000) . 'Pass';
			$companyCode = rand(1000, 9999);
			$code = $this->buildRandomString();
			$company = array(
				'contact_person' => $this->input->post('name'),
				'companyCode' => $companyCode,
				'contact_person_email' => $this->input->post('email'),
				'contact_person_cell' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'cell' => $this->input->post('phone'),
			);
			$this->admin_model->insert('companies', $company);

			$names = explode(' ', $this->input->post('name'));
			$admin = array(
				'comp_id' => $this->db->insert_id(),
				'name' => $names[0],
				'surname' => $names[1],
				'email' => $this->input->post('email'),
				'cell' => $this->input->post('phone'),
				'created_by' => 'Website Registration',
				'password' => md5($password),
				'verfication_code' => $code,
				'type' => 'Admin',
				'status' => 0,
				'last_login' => '0000-00-00 00:00:00',
			);
			$this->admin_model->insert('admin', $admin);

			$link = base_url('action/verify/?id=' . $this->db->insert_id() . '&code=' . $code);

			return $this->sendCreationMail($names[0], $this->input->post('email'), $link, $password, $companyCode);
		}
	}
	function sendCreationMail($name, $email, $link, $password, $companyCode)
	{
		$message = 'Your account has been created, to complete the registration please click the following link and verify you account!';
		$emailBody = $this->buildMailBody($email, $link, $password, $companyCode, $name, $message);

		$to = $email;
		$subject = $name . ' Account Creation';

		/* Load PHPMailer library */
		$this->load->library('phpmailer_lib');

		/* PHPMailer object */
		$mail = $this->phpmailer_lib->load();

		/* SMTP configuration */
		$mail->isSMTP();
		$mail->Host = 'smtp.hostinger.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'info@simaneka.com';
		$mail->Password = '15963QWErty!@#';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		$mail->setFrom('info@simaneka.com', SHORT_APP_NAME);
		$mail->addReplyTo('info@simaneka.com', 'Varde Daniel');

		/* Add a recipient */
		$mail->addAddress($to);

		/* Add cc or bcc */
		$mail->addCC('info@simaneka.com');
		// $mail->addBCC('info@simaneka.com');

		/* Email subject */
		$mail->Subject = $subject;

		/* Set email format to HTML */
		$mail->isHTML(true);

		/* Email body content */
		$mail->Body = $emailBody;

		/* Send email */
		if (!$mail->send()) {
			return array(
				'status' => false,
				'message' => $mail->ErrorInfo
			);
		} else {
			return array(
				'status' => true,
				'message' => "Account creation successfully, please cheack your mail for verification!"
			);
		}
	}

	public function buildMailBody($email, $link, $password, $companyCode, $name, $message)
	{
		return 'Hi, ' . $name . ' <br>'
			. $message . '<br><br>
		<a href="' . $link . '" style="text-decoration:none; background-color:#1F6B6D; padding:10px 20px; border:none; color:#fff; outline:none; border-radius: 10px" >Click Here To Activate Your Account</a>

		<br><br>
		---<br>
		<table style="width: 100%">
		  <tr>
		    <td style="width: 20%">Admin Panel</td>
		    <td style="width: 40%">' . base_url('admin') . '</td>
		  </tr>
		  <tr>
		    <td style="width: 20%">Email</td>
		    <td style="width: 40%">' . $email . '</td>
		  </tr>
		  <tr>
		    <td style="width: 20%">Password</td>
		    <td style="width: 40%">' . $password . '</td>
		  </tr>
		  <tr>
		    <td style="width: 20%">Company Code</td>
		    <td style="width: 40%">' . $companyCode . '</td>
		  </tr>
		</table><br>
		<p style="font-size: 10px; line-height: 150%;"><span style="font-family: Lato, sans-serif; font-size: 10px; line-height: 24px;">Thank you very much for you continual support and we hope that you are satisfied with the services provided, should have a complaint or query please do not hesiste to contact us on the details below!</span></p>
		';
	}
}