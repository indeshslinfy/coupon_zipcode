<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{
	function __construct() 
	{
		parent::__construct();
		$this->load->model('settings_model');
	}

	public function index()
	{
		# code...
	}

	/**
	 * contact us Page for this controller.
	 */
	public function contact_us()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"> <a href="#" data-dismiss="alert" aria-label="close" class="close">×</a>', '</div>');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			//$this->form_validation->set_rules('captcha_text', 'Captcha Displayed', 'required');
			//$this->form_validation->set_rules('captcha_response', 'Captcha', 'required|matches[captcha_text]', array('required' => 'You have not filled %s.', 'matches' => 'This %s is invalid.'));
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('validation_errs', validation_errors());
			}
			else
			{
				$params = $this->input->post();
				$params['first_name'] = trim(xss_clean($params['first_name'])); 
				$params['last_name'] = trim(xss_clean($params['last_name'])); 
				$params['email'] = trim(xss_clean($params['email']));  
				$params['phone_number'] = trim(xss_clean($params['phone_number'])); 
				$params['subject'] = trim(xss_clean($params['subject'])); 
				$params['message'] = trim(xss_clean($params['message'])); 
				try
				{
					$tickets_message['created_at'] = $params['created_at'] = date('Y-m-d H:i:s');

					// Insert Data into Ticket Table
					$tickets_message['message'] = $params['message'];
					unset($params['captcha_response']);
					unset($params['message']);
					$this->db->insert('tickets', $params);
					$id = $this->db->insert_id();

					// Insert Data into Ticket Message Table
					$tickets_message['ticket_id'] = $id;
					$this->db->insert('tickets_message', $tickets_message);
					if ($this->db->insert_id())
					{
						// Send Mail To Admin
						$params['ticket_id'] = $id;
						$params['message'] = $tickets_message['message'];
						$params['ticket_url'] = base_url() . ADMIN_PREFIX  . '/edit-ticket/' . $id;

						$email_details = $this->settings_model->get_settings('email');
						$general_settings = $this->settings_model->get_settings('general_settings');
						$params['company_name'] = $general_settings['company_name'];
						$html = $this->load->view('emails/contact-us', $params, TRUE);
						
						if ($params['ticket_type'] == TICKET_TYPE_CONTACT) 
						{
							$params['subject'] = 'Contact Us - ' . $params['subject'];
						}
						else if ($params['ticket_type'] == TICKET_TYPE_ADVERTISE) 
						{
							$params['subject'] = 'Advertise - ' . $params['subject'];
						}

						$this->email->from($params['email'], $params['first_name'] . ' ' . $params['last_name'])
									->to($email_details['admin_email'])
									->reply_to($params['email'], $params['first_name'] . ' ' . $params['last_name'])
									->subject($params['subject'])
									->message($html);
						$this->email->send();

						// Send Mail To User
						$params['ticket_url'] = base_url() . 'tickets/'  . base64_encode($id);
						$html = $this->load->view('emails/contact-us-user', $params, TRUE);
						
						$this->email->from($email_details['admin_email'])
									->to($params['email'])
									->reply_to($email_details['admin_email'])
									->subject($params['subject'])
									->message($html);
						$this->email->send();
					}
					else
					{
						$this->session->set_flashdata('error_msg', 'Something went wrong. Please try again.');
					}

					if ($params['ticket_type'] == TICKET_TYPE_CONTACT) 
					{
						$this->session->set_flashdata('success_msg', 'Thanks for contacting us. We will get back to you soon.');
						redirect(base_url('contact-us'));
					}

					$this->session->set_flashdata('success_msg', 'Thanks for show your interest for advertise with us. We will get back to you soon.');
					redirect(base_url('advertise'));
				}
				catch(Exception $e)
				{
					$this->session->set_flashdata('error_msg', 'Something went wrong. Please try again.');
				}
			}
		}

		$this->load->template('contact_us', array('title' => 'Contact Us'));

		/*$this->load->helper('captcha');
		$vals = array('img_path' => plugin_path() . 'captcha/',
					'img_url' => plugin_url() . 'captcha/',
					'img_width' => 120,
					'img_height' => 40,
					'img_id' => 'Imageid',
					'expiration' => 600, //10 minutes
					'word_length' => 5,
					'font_path' => 'https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700',
					'font_size' => 36,
					'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
		    		// White background and border, black text and red grid
				    'colors' => array('background' => array(49, 64, 64),
									'border' => array(0, 0, 0),
									'text' => array(255, 255, 255),
									'grid' => array(34, 111, 5)));

		$cap = create_captcha($vals);*/

		// $this->load->template('contact_us', array('title' => 'Contact Us','cap' => $cap));
		/*$data = array(
	        'captcha_time'  => $cap['time'],
	        'ip_address'    => $this->input->ip_address(),
	        'word'          => $cap['word']
		);

		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count == 0)
		{
		        echo 'You must submit the word that appears in the image.';
		}
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);*/
	}

	public function static_page()
	{
		if ($this->uri->segment(1) == 'how-it-works') 
		{
			$this->load->template('how_it_works');
		}
		else if ($this->uri->segment(1) == 'privacy-policy') 
		{
			$this->load->template('privacy_policy');
		}
		else if ($this->uri->segment(1) == 'terms-of-use') 
		{
			$this->load->template('terms_of_use');
		}
		else if ($this->uri->segment(1) == 'knowledge-base') 
		{
			$this->load->template('knowledge_base');
		}
	}

	public function average()
	{
		/*$test = get_zipcode_by_city('47036');
		print_r($test); die;*/
		$store_id = 1;
		$this->db->select_avg('rating');
		$this->db->from('reviews');
		$this->db->where(array('review_type' => REVIEW_TYPE_STORE, 'status' => REVIEW_STATUS_APPROVE, 'deleted_at' => NULL, 'receiver_id' => $store_id));
		$query = $this->db->get(); 
		$value = $query->row_array();
		$value = number_format($value['rating'],2);

		$value_part = explode('.', $value);
		if ($value_part[1] == 50 || $value_part[1] == 00) 
		{
			$value = $value;
		}
		else if ($value_part[1] > 00 && $value_part[1] <= 50) 
		{
			$value = $value[0] + 0.50;
		}
		elseif ($value_part[1] >= 51 && $value_part[1] <= 99) 
		{
			$value = $value[0] + 1;
		}
		print_r(number_format($value,2)); die;
		print_r($value); die;
	}
}