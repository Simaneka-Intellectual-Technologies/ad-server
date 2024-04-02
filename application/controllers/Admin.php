<?php
class Admin extends CI_Controller
{
	public function login()
	{
		$this->load->view('admin/templates/head');
		$this->load->view('admin/login');
		$this->load->view('admin/templates/bottom');
	}
	public function page($page = '', $type = '', $slug = '')
	{

		if ($this->session->userdata('logged_in') | $this->session->userdata('client_id')) {

			if ($page == 'payments' | $page == 'recordView') {

				$charge_total = 0;
				$payment_total = 0;
				$comp_id = false;

				$where = array(
					'charge_client_id' => $slug
				);

				$sort = array(
					'col' => 'charged_on',
					'by' => 'DESC',
				);
				if ($page == 'payments') {
					$comp_id = true;
				}
				$data['charges'] = $this->admin_model->get_where('charges', $where, $comp_id, $sort);

				if (count($data['charges']) > 0) {
					foreach ($data['charges'] as $charge) {
						$charge_total += $charge['charge_cost'];
					}

					$sort = array(
						'col' => 'payment_date',
						'by' => 'DESC'
					);
					$where = array(
						'payment_client_id' => $slug
					);
					$data['payments'] = $this->admin_model->get_where('payments', $where, $comp_id, $sort, null);

					foreach ($data['payments'] as $charge) {
						$payment_total += $charge['payment_price'];
					}

					$data['percentage_paid'] = round(($payment_total / $charge_total) * 100, 0);
					$data['percentage_remaining'] = 100 - $data['percentage_paid'];
					$data['outstanding_amount'] = $charge_total - $payment_total;
				} else {
					$data['percentage_paid'] = 100;
					$data['percentage_remaining'] = 0;
					$data['outstanding_amount'] = 0;
				}

				$where = array(
					'client_id' => $slug
				);
				$data['client'] = $this->admin_model->get_where('clients', $where, $comp_id, NULL);

			} elseif ($page == 'dashboard') {

				$lastLogin = $this->admin_model->get_login();

				$this->db->where('client_created_on >=', $lastLogin);
				$newClients = $this->admin_model->getAll('clients', true, NULL);

				$clientCount = count($newClients);

				$data['notification_count'] = $clientCount;
				if ($clientCount > 0) {

					for ($i = 0; $i < $clientCount; $i++) {
						$names[$i] = $newClients[$i]['client_name'];
					}

					$clientCount;
					$data['notification_names'] = $names;
				}
			} elseif ($page == 'pay') {
				$where = array(
					'charge_id' => $slug
				);
				$data['charge'] = $this->admin_model->get_where($type, $where, true, NULL)[0];
			} elseif ($page == 'create') {
				if ($type == 'client' && is_numeric($slug)) {
					$where = array(
						'client_id' => $slug
					);
					$data['client'] = $this->admin_model->get_where('clients', $where, true, null)[0];
				}
				if ($type == "billing") {
					$where = array(
						'client_status' => 1
					);
					$data['clients'] = $this->admin_model->get_where('clients', $where, true, null);
				}
				if ($type == "billing" && is_numeric($slug)) {
					$where = array(
						'billing_id' => $slug
					);
					$data['billing'] = $this->admin_model->get_where('billing', $where, true, null)[0];
				}
				if ($type == "charge" && is_numeric($slug)) {
					$where = array(
						'charge_id' => $slug
					);
					$data['charge'] = $this->admin_model->get_where('charges', $where, true, null)[0];
				}
				if ($type == "user" && is_numeric($slug)) {
					$where = array(
						'user_id' => $slug
					);
					$data['user'] = $this->admin_model->get_where('admin', $where, true, null)[0];
				}
				$data['type'] = $type;
			} elseif ($page == 'charges') {
				$sort = array(
					'col' => 'charged_on',
					'by' => 'DESC'
				);
				$data['charges'] = $this->admin_model->get_where($page, null, true, $sort);
			} elseif ($page == 'subscriptions') {
				$where = array(
					'subscription_end_date >=' => date('Y-m-d H:i:s')
				);
				$sort = array(
					'col' => 'subscription_end_date',
					'by' => 'DESC'
				);
				$data['subscription'] = $this->admin_model->get_where($page, $where, true, $sort);
				$data['packages'] = $this->admin_model->get_where('packages', null, false, null);
			} elseif ($page == 'publish') {
				
			} elseif ($page == 'companies') {
				$data['company'] = $this->admin_model->get_where($page, null, true, null)[0];
			} elseif ($page == 'bidders') {
				// $data['company'] = $this->admin_model->get_where($page, null, true, null)[0];
			} else {
				// $sort = array(
				// 	'col' => 'created_on',
				// 	'by' => 'DESC',
				// );
				$data[$page] = $this->admin_model->getAll($page, true, NULL);
			}


			if (file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
				$this->load->view('admin/templates/head', isset($data) ? $data : null);
				if ($this->session->userdata('logged_in')) {
					$this->load->view('admin/templates/navbar', isset($data) ? $data : null);
					$this->load->view('admin/templates/settings-panel');
					$this->load->view('admin/templates/sidebar');
				}
				$this->load->view('admin/' . $page, isset($data) ? $data : null);
				$this->load->view('admin/templates/footer');
				$this->load->view('admin/templates/bottom');
			} else {
				$this->load->view('admin/templates/head', isset($data) ? $data : null);
				$this->load->view('admin/404');
				$this->load->view('admin/templates/bottom');
			}
		} else {
			redirect(base_url('admin/login'));
		}
	}
	public function action($type, $slug = '', $id = '')
	{
		if ($this->session->userdata('logged_in')) {
			if ($type == 'charges') {
				//Getting charge information to insert correct payment data
				$where = array(
					'charge_id' => $slug
				);
				$charge = $this->admin_model->get_where($type, $where, true, null)[0];

				if ($charge['charge_paid'] == 0) {

					//Updating the Charge table to reflect that a payment was made if payment is full

					if ($charge['charge_cost'] - $this->input->post('amount') <= 0) {
						$update = array('charge_paid' => 1);
						$where = array('charge_id' => $slug);
						$this->admin_model->update('charges', $where, $update);
					}

					//Creating payment entry for the charge which was passed
					$data = array(
						'comp_id' => $this->session->userdata('comp_id'),
						'payment_reference' => $charge['charge_reference'],
						'payment_token' => $charge['charge_id'] . 'PM' . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"), -20),
						'payment_for' => $charge['charge_title'],
						'payment_price' => $this->input->post('amount'),
						'payment_by' => $this->session->userdata('name'),
						'payment_client_id' => $charge['charge_client_id'],
						'payment_client' => $charge['charge_client'],
					);
					$this->admin_model->insert('payments', $data);
				}

				redirect(base_url('admin/page/payments/view/' . $charge['charge_client_id']));
			} elseif ($type == 'logout') {
				$this->session->unset_userdata('user_id');
				$this->session->unset_userdata('comp_id');
				$this->session->unset_userdata('email');
				$this->session->unset_userdata('name');
				$this->session->unset_userdata('last_login');
				$this->session->unset_userdata('type');
				$this->session->unset_userdata('image');
				$this->session->unset_userdata('logged_in');

				redirect(base_url('admin/login'));
			} elseif ($type == 'create') {

				if ($_FILES['file']['name'] != '') {
					// $path = SPACE . '/' . str_replace(' ', '_', strtolower($this->input->post('type')));
					$path = SPACE;
					$config['allowed_types'] = 'gif|jpg|png|jpeg|word|pdf';
					$config['max_size'] = 2048;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;
					$config['upload_path'] = $path;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('file')) {
						print_r(array('error' => $this->upload->display_errors()));
						die();
					} else {
						$upload = array('upload_data' => $this->upload->data())['upload_data'];

						$image = str_replace(' ', '', strtolower($this->input->post('title'))) . date('Y_M_D_H_i_s') . $upload['file_ext'];
						rename($path .  $upload['file_name'], $path . $image);
						$data['file'] = base_url('/assets/ads/'. str_replace(' ', '_', strtolower($this->input->post('type'))) . '/' . $image);
					}
				}
				
				if ($slug == 'ad') {

					if ($this->input->post('ad_id')) {

						$data = array();
                    	foreach ($_POST as $key => $value) {


                    	    if ($key != substr($slug, 0, -1) . '_image') {
                    	        if ($key != 'password' || $this->input->post('password') != 'Do Not Change to Keep Password The Same') {
                    	            $data[$key] = ($key == 'password') ? md5($value) : $value;
                    	        }
                    	    }
                    	}

						die();
						$data = array(
							'comp_id' => $this->session->userdata('comp_id')
						);
						if ($this->input->post('viewPassword') != "Edit To Password") {
							$data = array(
								'viewPassword' => md5($this->input->post('viewPassword'))
							);
						}


						if ($_FILES['client_logo']['name'] != '') {
							$config['allowed_types'] = 'gif|jpg|png|jpeg|word|pdf';
							$config['max_size'] = 2048;
							$config['max_width'] = 2000;
							$config['max_height'] = 2000;
							$config['upload_path'] = SPACE . 'images/client_logos/';


							$this->load->library('upload', $config);

							if (!$this->upload->do_upload('client_logo')) {
								print_r(array('error' => $this->upload->display_errors()));
								die();
							} else {
								$upload = array('upload_data' => $this->upload->data())['upload_data'];

								$image = str_replace(' ', '', strtolower($this->input->post('client_name'))) . $upload['file_ext'];
								rename(SPACE . 'images/client_logos/' . $upload['file_name'], SPACE . 'images/client_logos/' . $image);

								$data['client_logo'] = base_url('/assets/admin/uploads/images/client_logos/' . $image);
							}
						}


						$where = array(
							'client_id' => $this->input->post('client_id')
						);

						if ($this->admin_model->update('clients', $where, $data)) {
							redirect(base_url('admin/page/clients'));
						}
					} else {
						$data = array();
			                    	foreach ($_POST as $key => $value) {
			                    	    if ($key != substr($slug, 0, -1) . '_image') {
			                    	        $data[$key] = ($key == 'password') ? md5($value) : $value;
			                    	    }
			                    	}

						
						print_r($data);
						die();
						$slug .= 's';
						if ($this->admin_model->insert($slug, $data)) {
							redirect(base_url('admin/page/'. $slug));
						}
					}
				} elseif ($slug == 'billing') {
					if ($this->input->post('billing_id')) {
						$client = explode('|', $this->input->post('billing_client'));
						$data = array(
							'billing_title' => $this->input->post('billing_title'),
							'comp_id' => $this->session->userdata('comp_id'),
							'billing_cost' => $this->input->post('billing_cost'),
							'status' => $this->input->post('billing_status'),
							'billing_date' => $this->input->post('billing_date'),
							'billing_frequency' => $this->input->post('billing_frequency'),
							'billing_client_company' => $client[1],
							'client_id' => $client[0],
							'created_by' => $this->session->userdata('name')
						);
						$where = array(
							'billing_id' => $this->input->post('billing_id')
						);

						if ($this->admin_model->update('billing', $where, $data)) {
							redirect(base_url('admin/page/billing'));
						}
					} else {
						$client = explode('|', $this->input->post('billing_client'));
						$data = array(
							'billing_title' => $this->input->post('billing_title'),
							'comp_id' => $this->session->userdata('comp_id'),
							'billing_cost' => $this->input->post('billing_cost'),
							'status' => $this->input->post('billing_status'),
							'billing_frequency' => $this->input->post('billing_frequency'),
							'billing_client_company' => $client[1],
							'client_id' => $client[0],
							'created_by' => $this->session->userdata('name')
						);

						if ($this->admin_model->insert('billing', $data)) {
							redirect(base_url('admin/page/billing'));
						}
					}
				} elseif ($slug == 'user') {
					if ($this->input->post('user_id')) {

						$data = array(
							'status' => $this->input->post('status'),
							'user_id' => $this->input->post('user_id'),
							'comp_id' => $this->session->userdata('comp_id'),
							'surname' => $this->input->post('surname'),
							'cell' => $this->input->post('cell'),
							'email' => $this->input->post('email'),
							'name' => $this->input->post('name'),
							'type' => $this->input->post('type')
						);

						if ($this->input->post('password') != "Edit To Change") {
							$data = array(
								'password' => md5($this->input->post('password'))
							);
						}

						if ($_FILES['user_image']['name'] != '') {
							$config['allowed_types'] = 'gif|jpg|png|jpeg|word|pdf';
							$config['max_size'] = 2048;
							$config['max_width'] = 1024;
							$config['max_height'] = 768;
							$config['upload_path'] = SPACE . 'images/users/';


							$this->load->library('upload', $config);

							if (!$this->upload->do_upload('user_image')) {
								print_r(array('error' => $this->upload->display_errors()));
								die();
							} else {
								$upload = array('upload_data' => $this->upload->data())['upload_data'];

								$image = strtolower($this->input->post('name')) . $this->input->post('user_id') . $upload['file_ext'];
								rename(SPACE . 'images/users/' . $upload['file_name'], SPACE . 'images/users/' . $image);

								$data['image'] = base_url('/assets/admin/uploads/images/users/' . $image);
							}
						}

						$where = array(
							'user_id' => $this->input->post('user_id')
						);

						if ($this->admin_model->update('admin', $where, $data)) {
							redirect(base_url('admin/page/admin'));
						}
					} else {
						$alpha = '';
						$alphabet = range('A', 'Z');
						while (strlen($alpha) < 5) {
							$alphabet = range('A', 'Z');
							$alpha .= $alphabet[rand(0, count($alphabet) - 1)];
						}
						$alpha .= rand(10000, 99999);

						$data = array(
							'name' => $this->input->post('name'),
							'comp_id' => $this->session->userdata('comp_id'),
							'surname' => $this->input->post('surname'),
							'email' => $this->input->post('email'),
							'cell' => $this->input->post('cell'),
							'password' => $this->input->post('password'),
							'type' => $this->input->post('type'),
							'verfication_code' => $alpha,
							'created_by' => $this->session->userdata('name')
						);

						if ($this->admin_model->insert('admin', $data)) {
							redirect(base_url('admin/page/admin'));
						}
					}
				} elseif ($slug == 'document') {
					$size = '';
					$type = '';
					if (count($_FILES) > 0) {

						$config['upload_path'] = SPACE . 'documents/';
						$config['allowed_types'] = 'docx|docs|doc|pdf|jpg|png|jpeg';
						$config['remove_spaces'] = TRUE;
						$config['encrypt_name'] = TRUE;

						$this->load->library('upload', $config);

						if (!$this->upload->do_upload('link')) {
							print_r($error = array('error' => $this->upload->display_errors()));
						} else {
							$upload = array('upload_data' => $this->upload->data());
						}

						$slug = '/assets/admin/uploads/documents/' . $upload['upload_data']['file_name'];
						$size = $_FILES['link']['size'] / 1000000;
						$type = $upload['upload_data']['file_ext'];

						// print_r($upload['upload_data']);
						// die();
					}
					if ($this->input->post('document_id')) {

						$data = array(
							'status' => $this->input->post('status'),
							'user_id' => $this->input->post('document_id'),
							'comp_id' => $this->session->userdata('comp_id'),
							'surname' => $this->input->post('surname'),
							'cell' => $this->input->post('cell'),
							'email' => $this->input->post('email'),
							'name' => $this->input->post('name'),
							'type' => $this->input->post('type')
						);

						if ($this->input->post('password') != "Edit To Change") {
							$data = array(
								'password' => md5($this->input->post('password'))
							);
						}

						if ($_FILES['user_image']['name'] != '') {
							$config['allowed_types'] = 'gif|jpg|png|jpeg|word|pdf';
							$config['max_size'] = 2048;
							$config['max_width'] = 1024;
							$config['max_height'] = 768;
							$config['upload_path'] = SPACE . 'images/users/';


							$this->load->library('upload', $config);

							if (!$this->upload->do_upload('document_image')) {
								print_r(array('error' => $this->upload->display_errors()));
								die();
							} else {
								$upload = array('upload_data' => $this->upload->data())['upload_data'];

								$image = strtolower($this->input->post('name')) . $this->input->post('document_id') . $upload['file_ext'];
								rename(SPACE . 'images/users/' . $upload['file_name'], SPACE . 'images/users/' . $image);

								$data['image'] = base_url('/assets/admin/uploads/images/users/' . $image);
							}
						}

						$where = array(
							'user_id' => $this->input->post('document_id')
						);

						if ($this->admin_model->update('admin', $where, $data)) {
							redirect(base_url('admin/page/admin'));
						}
					} else {

						$data = array(
							'title' => $this->input->post('document_name'),
							'comp_id' => $this->session->userdata('comp_id'),
							'description' => $this->input->post('document_description'),
							'created_by' => $this->session->userdata('name'),
							'slug' => ($slug != '') ? $slug : '',
							'size' => ($size != '') ? $size : '',
							'type' => ($type != '') ? $type : '',
						);

						if ($this->admin_model->insert('documents', $data)) {
							redirect(base_url('admin/page/documents'));
						}
					}
				} elseif ($slug == 'quote') {
					$_POST['total_cost'] = 0;
					$data['quote'] = $_POST;
					$data['company'] = $this->admin_model->get_where('companies', null, true, null)[0];
					$quote = $this->load->view('admin/plugins/quotes/quote_1', $data, TRUE);


					$data = array(
						'name' => $this->input->post('company_name'),
						'cell' => $this->input->post('company_cell'),
						'email' => $this->input->post('company_email'),
						'address' => $this->input->post('physical_address'),
						'comp_id' => $this->session->userdata('comp_id'),
						'quote' => $quote,
						'created_by' => $this->session->userdata('name'),
					);

					if ($this->admin_model->insert('quotes', $data)) {

						$config = array(
							'mailtype' => 'html',
						);

						$this->email->initialize($config);
						$this->email->from('no-reply@sytms.tech', SHORT_APP_NAME);
						$this->email->to($this->input->post('company_email'));
						$this->email->cc($data['company']['email']);
						$this->email->subject($this->input->post('company_name') . ' Quote ' . APP_NAME);
						$this->email->message($quote);
						$this->email->send();

						redirect(base_url('admin/page/quotes'));
					}
				} elseif ($slug == 'company') {

					if ($this->input->post('comp_id')) {
						$data = array();
						foreach ($_POST as $key => $value) {
							$data[$key] = $value;
						}


						if ($_FILES['company_logo']['name'] != '') {
							$config['allowed_types'] = 'gif|jpg|png|jpeg|word|pdf';
							$config['max_size'] = 2048;
							$config['max_width'] = 2000;
							$config['max_height'] = 2000;
							$config['upload_path'] = SPACE . 'images/company_logos/';
							$config['encrypt_name'] = TRUE;

							$this->load->library('upload', $config);

							if (!$this->upload->do_upload('company_logo')) {
								print_r(array('error' => $this->upload->display_errors()));
								die();
							} else {
								$upload = array('upload_data' => $this->upload->data())['upload_data'];

								$image = str_replace(' ', '', strtolower($this->input->post('title'))) . $upload['file_ext'];
								rename(SPACE . 'images/company_logos/' . $upload['file_name'], SPACE . 'images/company_logos/' . $image);

								$data['company_logo'] = base_url('/assets/admin/uploads/images/company_logos/' . $image);
							}
						}


						$where = array(
							'comp_id' => $this->input->post('comp_id')
						);

						if ($this->admin_model->update('companies', $where, $data)) {
							redirect(base_url('admin/page/companies'));
						}
					}
				}
			} elseif ($type == 'delete') {
				if ($slug == 'client') {
					$where = array(
						'client_id' => $id
					);

					$this->admin_model->delete('clients', $where, true);
					redirect(base_url('admin/page/dashboard'));
				} elseif ($slug == 'document') {
					$where = array(
						'document_id' => $id
					);

					$doc = $this->admin_model->get_where('documents', $where, true, null)[0];
					$space = '';
					if ($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp/htdocs') {
						$space = $_SERVER['DOCUMENT_ROOT'] . '/client-management-system/';
					} else {
						$space = $_SERVER['DOCUMENT_ROOT'] . '/';
					}

					if ($doc['slug'] != '') {
						if (file_exists($space . $doc['slug'])) {
							unlink($space . $doc['slug']);
						}
					}

					$this->admin_model->delete('documents', $where, true);
					redirect(base_url('admin/page/documents'));
				}
				if ($slug == 'quote') {
					$where = array(
						'quote_id' => $id
					);

					$this->admin_model->delete('quotes', $where, true);
					redirect(base_url('admin/page/quotes'));
				}
			}
		} else {
			redirect(base_url('admin/login'));
		}
	}
	public function ajax($type)
	{
		if ($type == 'login') {
			$where = array(
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password'))
			);

			$user = $this->admin_model->get_where('admin', $where, false, null);

			if ($user) {
				$user = $user[0];
				$data = array(
					'last_login' => date('Y-m-d H:i:s')
				);
				$where = array(
					'user_id' => $user['user_id']
				);
				if ($this->admin_model->update('admin', $where, $data)) {
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
					echo json_encode(
						array(
							'status' => true,
							'message' => 'Login was successful!'
						)
					);
				} else {
					echo json_encode(
						array(
							'status' => false,
							'message' => 'Invalid Login Details!'
						)
					);
				}
			} else {
				echo json_encode(
					array(
						'status' => false,
						'message' => 'Invalid Login Details!'
					)
				);
			}
		}
		if ($type == 'viewLogin') {
			$where = array(
				'client_id' => $this->input->post('client_id'),
				'viewPassword' => md5($this->input->post('password'))
			);

			$user = $this->admin_model->get_where('clients', $where, false, null);

			if ($user) {
				if ($this->session->unset_userdata('logged_in')) {
					$this->session->unset_userdata('user_id');
					$this->session->unset_userdata('comp_id');
					$this->session->unset_userdata('email');
					$this->session->unset_userdata('name');
					$this->session->unset_userdata('last_login');
					$this->session->unset_userdata('type');
					$this->session->unset_userdata('logged_in');
				}

				$data = array(
					'client_id' => $this->input->post('client_id')
				);
				$this->session->set_userdata($data);

				echo json_encode(
					array(
						'status' => true,
						'message' => 'Login was successful!'
					)
				);
			} else {
				echo json_encode(
					array(
						'status' => false,
						'message' => 'Invalid Login Details!'
					)
				);
			}
		}
		if ($type == 'quote') {
			if ($this->session->userdata('logged_in')) {
				$where = array(
					'quote_id' => $this->input->post('quote_id')
				);
				$quote = $this->admin_model->get_where('quotes', $where, true, null);

				if ($quote) {
					echo json_encode(
						array(
							'status' => true,
							'message' => 'Quote was Successfully Retrieved!',
							'quote' => $quote[0]
						)
					);
				} else {
					echo json_encode(
						array(
							'status' => false,
							'message' => 'Quote was not Found!',
							'quote' => ''
						)
					);
				}

			}
		}
		if ($type == 'sendQuote') {
			if ($this->session->userdata('logged_in')) {
				$where = array(
					'quote_id' => $this->input->post('quote_id')
				);
				$quote = $this->admin_model->get_where('quotes', $where, true, null)[0];
				$company = $this->admin_model->get_where('companies', null, true, null)[0];

				$config = array(
					'mailtype' => 'html',
				);

				$this->email->initialize($config);
				$this->email->from('no-reply@sytms.tech', SHORT_APP_NAME);
				$this->email->to($quote['email']);
				$this->email->cc($company['email']);
				$this->email->subject($quote['name'] . ' Quote ' . APP_NAME);
				$this->email->message($quote['quote']);

				if ($this->email->send()) {
					echo json_encode(
						array(
							'status' => true,
							'message' => 'Quote Sent to ' . $quote['email']
						)
					);
				} else {
					echo json_encode(
						array(
							'status' => false,
							'message' => 'Quote Could Not Be Sent!'
						)
					);
				}
			}
		}
	}
	public function checkPaidCharges()
	{
		$charges = $this->admin_model->getAll('charges', false, NULL);
		$payments = $this->admin_model->getAll('payments', false, NULL);

		foreach ($charges as $charge) {
			$chargeAmount = $charge['charge_cost'];

			foreach ($payments as $payment) {
				if ($charge['charge_reference'] == $payment['payment_reference']) {
					$chargeAmount -= $payment['payment_price'];
				}
			}
			if ($chargeAmount == 0) {
				$update = array('charge_paid' => 1);
				$where = array('charge_id' => $charge['charge_id']);
				$this->admin_model->update('charges', $where, $update);
			}
		}
	}
	public function client($action, $client_id = '0')
	{
		if ($action == 'login') {
			$data['client_id'] = $client_id;

			$this->load->view('admin/templates/head');
			$this->load->view('admin/client', $data);
			$this->load->view('admin/templates/bottom');
		}
	}
	public function cron($frequency, $type)
	{
		if ($type == 'retrack') {
			for ($i = 8; $i < 10; $i++) {
				$ccPart = '';
				$ctPart = '';
				$cc = explode(' ', "Fillemon Silvanus");
				$ct = explode(' ', 'Website Hosting');
				foreach ($cc as $c) {
					$ccPart .= strtolower(substr($c, 0, 1));
				}
				foreach ($ct as $c) {
					$ctPart .= strtolower(substr($c, 0, 1));
				}
				$ctPart .= rand(10000, 99999);
				$ciPart = 'cid-8';
				$ccPart .= rand(10000, 99999);

				$data = array(
					'comp_id' => 1,
					'charge_title' => 'Website Hosting - ' . date("F", mktime(0, 0, 0, $i, 1)) . ' 2023',
					'charge_cost' => 70,
					'charge_client' => "Fillemon Silvanus",
					'charge_client_id' => 8,
					'charged_on' => '2023-0' . $i . '-06 18:55:19',
					'charge_reference' => $ciPart . '_' . 'ct-' . $ctPart . '_ccl-' . $ccPart,
				);

				// $this->admin_model->insert('charges', $data);
			}


		}
		//*********************************************** */

		// Cron for billing 
		// http://localhost/client-management-system-1/admin/cron/monthly/billing

		//*********************************************** */

		if ($type == "billing") {
			$where = array(
				'status' => 1
			);

			$bills = $this->admin_model->get_where('billing', $where, false, null);

			$where2 = array(
				'MONTH(charged_on) =' => date('m'),
				'YEAR(charged_on) =' => date('Y')
			);

			$charges = $this->admin_model->get_where('charges', $where2, false, null);

			foreach ($charges as $charge) {
				foreach ($bills as $key => $bill) {
					if ($bill['client_id'] == $charge['charge_client_id']) {
						unset($bills[$key]);
					}
				}
			}

			if (count($bills) > 0) {
				foreach ($bills as $bill) {

					if ($bill['billing_date'] == date('d')) {
						$ccPart = '';
						$ctPart = '';
						$cc = explode(' ', $bill['billing_client_company']);
						$ct = explode(' ', $bill['billing_title']);
						foreach ($cc as $c) {
							$ccPart .= strtolower(substr($c, 0, 1));
						}
						foreach ($ct as $c) {
							$ctPart .= strtolower(substr($c, 0, 1));
						}
						$ctPart .= rand(10000, 99999);
						$ciPart = 'cid-' . $bill['client_id'];
						$ccPart .= rand(10000, 99999);

						$data = array(
							'comp_id' => $bill['comp_id'],
							'charge_title' => $bill['billing_title'] . ' - ' . date('M') . ' ' . date('Y'),
							'charge_cost' => $bill['billing_cost'],
							'charge_client' => $bill['billing_client_company'],
							'charge_client_id' => $bill['client_id'],
							'charge_reference' => $ciPart . '_' . 'ct-' . $ctPart . '_ccl-' . $ccPart,
						);


						if ($this->admin_model->insert('charges', $data)) {
							$this->sendBalanceMail($bill['client_id']);
							echo $bill['billing_client_company'] . ' was billed ' . $bill['billing_cost'] . '<br><br>';
						}
					}
				}
			}
		}

		// ******************************
		// Cron That Sends Mails For Outstanding Payments
		// ******************************
		if ($type == "mails") {

			$clients = $this->admin_model->get_where('clients', null, false, null);

			shuffle($clients);
			foreach ($clients as $client) {

				$charge_total = 0;
				$payment_total = 0;

				$where = array(
					'charge_client_id' => $client['client_id']
				);

				$sort = array(
					'col' => 'charged_on',
					'by' => 'DESC',
				);
				$data['charges'] = $this->admin_model->get_where('charges', $where, false, $sort);

				if (count($data['charges']) > 0) {
					foreach ($data['charges'] as $charge) {
						$charge_total += $charge['charge_cost'];
					}

					$sort = array(
						'col' => 'payment_date',
						'by' => 'DESC'
					);
					$where = array(
						'payment_client_id' => $client['client_id']
					);
					$data['payments'] = $this->admin_model->get_where('payments', $where, false, $sort, null);
					foreach ($data['payments'] as $charge) {
						$payment_total += $charge['payment_price'];
					}

					$percentage_paid = round(($payment_total / $charge_total) * 100, 0);
					$percentage_remaining = 100 - $percentage_paid;
					$outstanding_amount = $charge_total - $payment_total;

					$lastCharge = array_slice($data['charges'], 0, 1, true)[0];

					$chargeData = array(
						'previous' => $outstanding_amount - $lastCharge['charge_cost'],
						'last' => $lastCharge,
						'total' => $outstanding_amount
					);
					$where3 = array('comp_id' => $data['charges'][0]['comp_id']);
					$companyName = $this->admin_model->get_where('companies', $where3, false, false)[0]['title'];
				} else {
					$percentage_paid = 100;
					$percentage_remaining = 0;
					$outstanding_amount = 0;
					$companyName = '';
				}

				$message = '';

				if ($outstanding_amount == 0) {
					$message = 'You have paid all their bills and have a balance of N$ ' . $outstanding_amount . ' to ' . $companyName;
				} elseif ($outstanding_amount < 0) {
					$message = 'You have an access amount of N$ ' . ($outstanding_amount * -1) . ' owed to you by ' . $companyName . '. We appriciate your continual support an should you wish to retrieve this amount, do not hesitate to contact us and we will ensure to make the transfer!';
				} else {
					$message = 'You have an outstanding amount of N$ ' . $outstanding_amount . ' to ' . $companyName . '. We advice that you settle your account so that you avoid the suspension of the services!';
				}

				$this->admin_model->sendMonthlyAlert($client, $message, $data['charges'], $outstanding_amount > 0, $chargeData);
			}
		}
	}
	public function sendBalanceMail($id)
	{
		$cleintWhere = array(
			'client_id' => $id
		);
		$clients = $this->admin_model->get_where('clients', $cleintWhere, false, null);

		foreach ($clients as $client) {

			$charge_total = 0;
			$payment_total = 0;

			$where = array(
				'charge_client_id' => $client['client_id']
			);

			$sort = array(
				'col' => 'charged_on',
				'by' => 'DESC',
			);
			$data['charges'] = $this->admin_model->get_where('charges', $where, false, $sort);

			if (count($data['charges']) > 0) {
				foreach ($data['charges'] as $charge) {
					$charge_total += $charge['charge_cost'];
				}

				$sort = array(
					'col' => 'payment_date',
					'by' => 'DESC'
				);
				$where = array(
					'payment_client_id' => $client['client_id']
				);
				$data['payments'] = $this->admin_model->get_where('payments', $where, false, $sort, null);
				foreach ($data['payments'] as $charge) {
					$payment_total += $charge['payment_price'];
				}

				$percentage_paid = round(($payment_total / $charge_total) * 100, 0);
				$percentage_remaining = 100 - $percentage_paid;
				$outstanding_amount = $charge_total - $payment_total;

				$lastCharge = array_slice($data['charges'], 0, 1, true)[0];

				$chargeData = array(
					'previous' => $outstanding_amount - $lastCharge['charge_cost'],
					'last' => $lastCharge,
					'total' => $outstanding_amount
				);
				$where3 = array('comp_id' => $data['charges'][0]['comp_id']);
				$companyName = $this->admin_model->get_where('companies', $where3, false, false)[0]['title'];
			} else {
				$percentage_paid = 100;
				$percentage_remaining = 0;
				$outstanding_amount = 0;
				$companyName = '';
			}

			$message = '';

			if ($outstanding_amount == 0) {
				$message = 'You have paid all their bills and have a balance of N$ ' . $outstanding_amount . ' to ' . $companyName;
			} elseif ($outstanding_amount < 0) {
				$message = 'You have an access amount of N$ ' . ($outstanding_amount * -1) . ' owed to you by ' . $companyName . '. We appriciate your continual support an should you wish to retrieve this amount, do not hesitate to contact us and we will ensure to make the transfer!';
			} else {
				$message = 'You have an outstanding amount of N$ ' . $outstanding_amount . ' to ' . $companyName . '. We advice that you settle your account so that you avoid the suspension of the services!';
			}

			$this->admin_model->sendMonthlyAlert($client, $message, $data['charges'], $outstanding_amount > 0, $chargeData);
		}
	}
}
