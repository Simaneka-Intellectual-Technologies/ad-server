<?php
class Admin_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function get_version()
	{
		$this->db->limit(1);
		$this->db->from('versions');
		$this->db->order_by('update_date', "DESC");
		return $this->db->get()->row_array();
	}
	public function get_select_options($table, $id, $column)
	{
		$this->db->from($table);
		$this->db->order_by($column, "DESC");
		$query = $this->db->get();
		if ($query->result()) {
			foreach ($query->result_array() as $row) {
				echo '<option ' . (($id == $row[$column]) ? 'select' : '') . ' value="' . $row[$column] . '">' . $row[$column] . '</option>';
			 }
		}
	}
	public function get_login()
	{
		$this->db->select("logged_in");
		$this->db->from("admin_log");
		$this->db->limit(1);
		$this->db->order_by('log_id', "DESC");
		$query = $this->db->get();
		if ($query->result()) {
			return $query->result()[0]->logged_in;
		}
		return false;
	}
	public function update($table, $where, $data)
	{
		$this->db->where($where);
		if ($this->db->update($table, $data)) {
			return true;
		}

		return false;
	}
	public function getAll($table, $addCompID, $sort)
	{
		if ($sort) {
			$this->db->order_by($sort['col'], $sort['by']);
		}
		if ($addCompID) {
			$this->db->where('comp_id', $this->session->userdata('comp_id'));
		}
		return $this->db->get_where($table)->result_array();
	}
	public function get_where($table, $where, $addCompID, $sort)
	{
		if ($sort) {
			$this->db->order_by($sort['col'], $sort['by']);
		}
		if ($addCompID) {
			$this->db->where('comp_id', $this->session->userdata('comp_id'));
		}
		$query = $this->db->get_where($table, $where);
		return $query->result_array();
	}
	public function insert($table, $data)
	{
		if ($this->db->insert($table, $data)) {
			return true;
		}

		return false;
	}
	public function delete($table, $where, $addCompID)
	{
		if ($addCompID) {
			$this->db->where('comp_id', $this->session->userdata('comp_id'));
		}
		$this->db->where($where);
		if ($this->db->delete($table)) {
			return true;
		}
		return false;
	}
	public function sendMonthlyAlert($client, $message, $charges, $inArrear, $chargeData)
	{
		 /* Load PHPMailer library */
	        $this->load->library('phpmailer_lib');
	       
	        /* PHPMailer object */
	        $mail = $this->phpmailer_lib->load();
	       
	        /* SMTP configuration */
	        $mail->isSMTP();
	        $mail->Host     = 'smtp.hostinger.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'info@simaneka.com';
	        $mail->Password = '15963QWErty!@#';
	        $mail->SMTPSecure = 'ssl';
	        $mail->Port     = 465;
	       
	        $mail->setFrom('info@simaneka.com', 'Client Management System');
	        $mail->addReplyTo('info@simaneka.com', 'Support');
	       
	        /* Add a recipient */
			$to = 'vardesimaneka@gmail.com';
	        $mail->addAddress($to);
	       
	        /* Add cc or bcc */
	        // $mail->addCC('info@simaneka.com');
	        // $mail->addBCC('info@simaneka.com');
	       
	        /* Email subject */
	        $mail->Subject = $client['client_name'] . ' Account Balance Notification';;
	       
	        /* Set email format to HTML */
	        $mail->isHTML(true);
	       
	        /* Email body content */
			$firstSight = $this->nameAndMessage($client['client_name'], $message);
	        $mail->Body = $this->buildMailBody($firstSight, $chargeData, $inArrear);
	       
	        /* Send email */
	        if(!$mail->send()){
	            var_dump($mail->ErrorInfo);
	        }else{
				echo 'Sent mail to ' . $client['client_email'] . '<br>';
	        }

	}
	public function nameAndMessage($name, $message)
	{
		return '<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
					<tbody>
					  <tr>
						<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 0px 15px;font-family:"Raleway",sans-serif;" align="left">
							<h1 class="v-text-align" style="margin: 0px; color: #fefeff; line-height: 140%; text-align: left; word-wrap: break-word; font-family: "Raleway",sans-serif; font-size: 22px; font-weight: 400;">Dear ' . $name . '</h1>
						</td>
					  </tr>
					</tbody>
	  			</table>

	  			<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
					<tbody>
					  <tr>
						<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 15px;font-family:"Raleway",sans-serif;" align="left">
							<div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 150%; text-align: left; word-wrap: break-word;">
							  <p style="font-size: 14px; line-height: 150%;"><span style="font-family: Lato, sans-serif; font-size: 16px; line-height: 24px;">' . $message . '</span></p>
							</div>
						</td>
					  </tr>
					</tbody>
	  			</table>';
	}
	public function buildMailBody($firstSight, $chargeData, $inArrear)
	{
		return '
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head>
		<!--[if gte mso 9]>
		<xml>
		  <o:OfficeDocumentSettings>
		    <o:AllowPNG/>
		    <o:PixelsPerInch>96</o:PixelsPerInch>
		  </o:OfficeDocumentSettings>
		</xml>
		<![endif]-->
		  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		  <meta name="x-apple-disable-message-reformatting">
		  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
		  <title></title>

		    <style type="text/css">
		      @media only screen and (min-width: 570px) {
		  .u-row {
		    width: 550px !important;
		  }
		  .u-row .u-col {
		    vertical-align: top;
		  }
	  
		  .u-row .u-col-24p79 {
		    width: 136.345px !important;
		  }
	  
		  .u-row .u-col-25 {
		    width: 50% !important;
		  }
	  
		  .u-row .u-col-33p33 {
		    width: 183.315px !important;
		  }
	  
		  .u-row .u-col-41p88 {
		    width: 230.34px !important;
		  }
	  
		  .u-row .u-col-100 {
		    width: 550px !important;
		  }
	  
		}

		@media (max-width: 570px) {
		  .u-row-container {
		    max-width: 100% !important;
		    padding-left: 0px !important;
		    padding-right: 0px !important;
		  }
		  .u-row .u-col {
		    min-width: 320px !important;
		    max-width: 100% !important;
		    display: block !important;
		  }
		  .u-row {
		    width: 100% !important;
		  }
		  .u-col {
		    width: 100% !important;
		  }
		  .u-col > div {
		    margin: 0 auto;
		  }
		}
		body {
		  margin: 0;
		  padding: 0;
		}

		table,
		tr,
		td {
		  vertical-align: top;
		  border-collapse: collapse;
		}

		p {
		  margin: 0;
		}

		.ie-container table,
		.mso-container table {
		  table-layout: fixed;
		}

		* {
		  line-height: inherit;
		}

		a[x-apple-data-detectors="true"] {
		  color: inherit !important;
		  text-decoration: none !important;
		}

		@media (max-width: 480px) {
		  .hide-mobile {
		    max-height: 0px;
		    overflow: hidden;
		    display: none !important;
		  }
		}

		table, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_text_4 .v-container-padding-padding { padding: 15px 10px 10px !important; } #u_content_text_2 .v-container-padding-padding { padding: 10px 10px 15px !important; } #u_content_image_5 .v-container-padding-padding { padding: 15px 10px 20px !important; } #u_content_image_5 .v-src-width { width: auto !important; } #u_content_image_5 .v-src-max-width { max-width: 52% !important; } #u_content_image_4 .v-container-padding-padding { padding: 15px 10px 20px !important; } #u_content_image_4 .v-src-width { width: auto !important; } #u_content_image_4 .v-src-max-width { max-width: 52% !important; } #u_content_text_17 .v-container-padding-padding { padding: 10px !important; } #u_content_text_17 .v-text-align { text-align: center !important; } #u_content_text_5 .v-container-padding-padding { padding: 10px 10px 20px !important; } }
		    </style>



		<!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->
		
		</head>
		
		<body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000">
		  <!--[if IE]><div class="ie-container"><![endif]-->
		  <!--[if mso]><div class="mso-container"><![endif]-->
		  <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
		  <tbody>
		  <tr style="vertical-align: top">
		    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
		    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #ffffff;"><![endif]-->
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
		
		<!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 15px;font-family:"Raleway",sans-serif;" align="left">
		
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		  <tr>
		    <td class="v-text-align" style="padding-right: 0px;padding-left: 0px;" align="center">
		
		      <img align="center" border="0" src="' . base_url('assets/admin/images/email/image-7.png') . '" alt="Logo" title="Logo" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 27%;max-width: 143.1px;" width="143.1" class="v-src-width v-src-max-width"/>
		
		    </td>
		  </tr>
		</table>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    </div>
		  </div>
		  </div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #006c6e;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #006c6e;"><![endif]-->
		
		<!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:"Raleway",sans-serif;" align="left">
		
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		  <tr>
		    <td class="v-text-align" style="padding-right: 0px;padding-left: 0px;" align="center">
		
		      <img align="center" border="0" src="' . base_url('assets/admin/images/email/image-5.png') . '" alt="Invoice Banner" title="Invoice Banner" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 52%;max-width: 275.6px;" width="275.6" class="v-src-width v-src-max-width"/>
		
		    </td>
		  </tr>
		</table>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    </div>
		  </div>
		  </div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #03989e;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #03989e;"><![endif]-->
		
		<!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		' . $firstSight . '
		
				<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
				  <tbody>
				    <tr>
				      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 12px;font-family:"Raleway",sans-serif;" align="left">

				  <div class="v-text-align" style="font-size: 14px; color: #2c3581; line-height: 140%; text-align: center; word-wrap: break-word;">
				    <p style="font-size: 14px; line-height: 140%;"><strong>I N V O I C E&nbsp; &nbsp;</strong> R E C A P</p>
				  </div>

				      </td>
				    </tr>
				  </tbody>
				</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    </div>
		  </div>
		  </div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  	<div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #00868a;">
		    	<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      		<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #00868a;"><![endif]-->
						<!--[if (mso)|(IE)]><td align="center" width="137" style="width: 137px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
							<div class="u-col u-col-25" style="max-width: 320px;min-width: 50%;display: table-cell;vertical-align: top;">
		  						<div style="height: 100%;width: 100% !important;">
		  							<!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
										<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
										  <tbody>
										    <tr>
										      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Raleway",sans-serif;" align="left">

										  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
										    <p style="font-size: 14px; line-height: 140%;"><strong>Description<br /></strong></p>
										  </div>

										      </td>
										    </tr>
										  </tbody>
										</table>
		  							<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  						</div>
							</div>
						<!--[if (mso)|(IE)]></td><![endif]-->

						<!--[if (mso)|(IE)]><td align="center" width="137" style="width: 137px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
							<div class="u-col u-col-25" style="max-width: 320px;min-width: 50%;display: table-cell;vertical-align: top;">
							  <div style="height: 100%;width: 100% !important;">
							  	<!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
									<table id="u_content_text_2" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
									  <tbody>
									    <tr>
									      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Raleway",sans-serif;" align="left">

									  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
									    <p style="font-size: 14px; line-height: 140%;"><strong>Sub Total<br /></strong></p>
									  </div>

									      </td>
									    </tr>
									  </tbody>
									</table>
							  	<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
							  </div>
							</div>
						<!--[if (mso)|(IE)]></td><![endif]-->
		      		<!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    	</div>
		  	</div>
		</div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #03989e;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      	<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #03989e;"><![endif]-->
					<!--[if (mso)|(IE)]><td align="center" width="137" style="width: 137px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
					<div class="u-col u-col-25" style="max-width: 320px;min-width: 50%;display: table-cell;vertical-align: top;">
					  <div style="height: 100%;width: 100% !important;">
					  	<!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
							<table class="hide-mobile" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
							  <tbody>
							    <tr>
							      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:13px;font-family:"Raleway",sans-serif;" align="left">

							  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
							    <tbody>
							      <tr style="vertical-align: top">
							        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
							          <span>&#160;</span>
							        </td>
							      </tr>
							    </tbody>
							  </table>

							      </td>
							    </tr>
							  </tbody>
							</table>

							<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
							  <tbody>
							    <tr>
							      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Raleway",sans-serif;" align="left">

							  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
							    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 12px; line-height: 16.8px;">Overflow from previous billings</span></p>
							  </div>

							      </td>
							    </tr>
							  </tbody>
							</table>
					  	<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
					  </div>
					</div>
					<!--[if (mso)|(IE)]></td><![endif]-->
	
					<!--[if (mso)|(IE)]><td align="center" width="137" style="width: 137px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
						<div class="u-col u-col-25" style="max-width: 320px;min-width: 50%;display: table-cell;vertical-align: top;">
		  					<div style="height: 100%;width: 100% !important;">
		  						<!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
									<table class="hide-mobile" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  								<tbody>
		    								<tr>
		      									<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:11px;font-family:"Raleway",sans-serif;" align="left">
													<table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		    											<tbody>
		      												<tr style="vertical-align: top">
		        												<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		          													<span>&#160;</span>
		        												</td>
		      												</tr>
		    											</tbody>
		  											</table>
		      									</td>
		    								</tr>
		  								</tbody>
									</table>
		
									<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
									  	<tbody>
									  	  	<tr>
									  	    	<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 20px;font-family:"Raleway",sans-serif;" align="left">
									  				<div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
									  	  				<p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;">N$ ' . $chargeData['previous'] . '</span></p>
									  				</div>
									  	    	</td>
									  	  	</tr>
									  	</tbody>
									</table>
		
		  						<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  					</div>
						</div>
					<!--[if (mso)|(IE)]></td><![endif]-->
		      	<!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    	</div>
		  	</div>
		</div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #03989e;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #03989e;"><![endif]-->
		
		<!--[if (mso)|(IE)]><td align="center" width="137" style="width: 137px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-25" style="max-width: 320px;min-width: 50%;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table class="hide-mobile" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:13px;font-family:"Raleway",sans-serif;" align="left">
		
		  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		    <tbody>
		      <tr style="vertical-align: top">
		        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		          <span>&#160;</span>
		        </td>
		      </tr>
		    </tbody>
		  </table>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Raleway",sans-serif;" align="left">
		
		  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
		    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 12px; line-height: 16.8px;">' . $chargeData['last']['charge_title'] . '</span></p>
		  </div>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->

		<!--[if (mso)|(IE)]><td align="center" width="137" style="width: 137px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-25" style="max-width: 320px;min-width: 50%;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table class="hide-mobile" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:11px;font-family:"Raleway",sans-serif;" align="left">
		
		  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		    <tbody>
		      <tr style="vertical-align: top">
		        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		          <span>&#160;</span>
		        </td>
		      </tr>
		    </tbody>
		  </table>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 20px;font-family:"Raleway",sans-serif;" align="left">
		
		  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
		    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;">N$ ' . $chargeData['last']['charge_cost'] . '</span></p>
		  </div>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    </div>
		  </div>
		  </div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #00868a;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #00868a;"><![endif]-->
		
		<!--[if (mso)|(IE)]><td align="center" width="183" style="width: 183px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-33p33" style="max-width: 320px;min-width: 183.31px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Raleway",sans-serif;" align="left">
		
		  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		    <tbody>
		      <tr style="vertical-align: top">
		        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
		          <span>&#160;</span>
		        </td>
		      </tr>
		    </tbody>
		  </table>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		<!--[if (mso)|(IE)]><td align="center" width="230" style="width: 230px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-41p88" style="max-width: 320px;min-width: 230.34px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table id="u_content_text_17" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 0px 10px 10px;font-family:"Raleway",sans-serif;" align="left">
		
		  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: right; word-wrap: break-word;">
		    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;"><strong>Total :</strong></span></p>
		  </div>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		<!--[if (mso)|(IE)]><td align="center" width="136" style="width: 136px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-24p79" style="max-width: 320px;min-width: 136.34px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table id="u_content_text_5" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Raleway",sans-serif;" align="left">
		
		  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
		    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 20px; line-height: 28px; font-family: "Open Sans", sans-serif;">N$ ' . $chargeData['total'] . '</span></p>
		  </div>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    </div>
		  </div>
		  </div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #03989e;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #03989e;"><![endif]-->
		
		<!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px 10px 15px;font-family:"Raleway",sans-serif;" align="left">
		
		  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 150%; text-align: left; word-wrap: break-word;">
		    <p style="font-size: 14px; line-height: 150%;"><span style="font-family: Lato, sans-serif; font-size: 16px; line-height: 24px;">If there are any issues delaying payment (e.g. missing invoice, incorrect information etc.) please do let me know and I can send the relevant information!</span></p> <br><br>
		    <p style="font-size: 14px; line-height: 150%;"><span style="font-family: Lato, sans-serif; font-size: 16px; line-height: 24px;">Thank you very much for you continual support and we hope that you are satisfied with the services provided, should have a complaint or query please do not hesiste to contact us on the details below!</span></p>
		  </div>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    </div>
		  </div>
		  </div>
		
		
		
		
		
		<div class="u-row-container" style="padding: 0px;background-color: transparent">
		  <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #03989e;">
		    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
		      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #03989e;"><![endif]-->
		
		<!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
		<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
		  <div style="height: 100%;width: 100% !important;">
		  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:35px 10px 10px;font-family:"Raleway",sans-serif;" align="left">
		
		<div align="center">
		  <div style="display: table; max-width:171px;">
		  <!--[if (mso)|(IE)]><table width="171" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:171px;"><tr><![endif]-->
		
		
		    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 11px;" valign="top"><![endif]-->
		    <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 11px">
		      <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
		        <a href="https://facebook.com/" title="Facebook" target="_blank">
		          <img src="' . base_url('assets/admin/images/email/image-1.png') . '" alt="Facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
		        </a>
		      </td></tr>
		    </tbody></table>
		    <!--[if (mso)|(IE)]></td><![endif]-->
		
		    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 11px;" valign="top"><![endif]-->
		    <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 11px">
		      <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
		        <a href="https://twitter.com/" title="Twitter" target="_blank">
		          <img src="' . base_url('assets/admin/images/email/image-2.png') . '" alt="Twitter" title="Twitter" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
		        </a>
		      </td></tr>
		    </tbody></table>
		    <!--[if (mso)|(IE)]></td><![endif]-->
		
		    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 11px;" valign="top"><![endif]-->
		    <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 11px">
		      <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
		        <a href="https://linkedin.com/" title="LinkedIn" target="_blank">
		          <img src="' . base_url('assets/admin/images/email/image-3.png') . '" alt="LinkedIn" title="LinkedIn" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
		        </a>
		      </td></tr>
		    </tbody></table>
		    <!--[if (mso)|(IE)]></td><![endif]-->
		
		    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 0px;" valign="top"><![endif]-->
		    <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
		      <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
		        <a href="https://instagram.com/" title="Instagram" target="_blank">
		          <img src="' . base_url('assets/admin/images/email/image-4.png') . '" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
		        </a>
		      </td></tr>
		    </tbody></table>
		    <!--[if (mso)|(IE)]></td><![endif]-->
		
		
		    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		  </div>
		</div>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		<table style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
		  <tbody>
		    <tr>
		      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 30px;font-family:"Raleway",sans-serif;" align="left">
		
		  <div class="v-text-align" style="font-size: 14px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
		    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 12px; line-height: 16.8px;">This system is powered by Simaneka Intellectual Technologies</span></p>
		  </div>
		
		      </td>
		    </tr>
		  </tbody>
		</table>
		
		
		  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
		  </div>
		</div>
		<!--[if (mso)|(IE)]></td><![endif]-->
		      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		    </div>
		  </div>
		  </div>
		
		
		
		    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
		    </td>
		  </tr>
		  </tbody>
		  </table>
		  <!--[if mso]></div><![endif]-->
		  <!--[if IE]></div><![endif]-->
		</body>
		
		</html>

		';
	}
}
