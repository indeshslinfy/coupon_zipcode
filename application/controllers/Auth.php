<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	/**
	 * Login Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/login
	 *	- or -
	 * 		http://example.com/register
	 *	- or -
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /auth/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$err_message = "Login failed. Invalid Email or Password.";
			$user_exist = $this->auth_model->user_login(array("email" => $this->input->post('email'), "password" => $this->input->post('password')));
			if ($user_exist)
			{
				if ($user_exist['status'] == USER_STATUS_INACTIVE)
				{
					$err_message = "Login failed. You account is not active";
				}
				else
				{
					$this->load->model(ADMIN_PREFIX . '/user_model');
					$user_details = $this->user_model->user_edit($user_exist['id']);

					$this->session->set_userdata('logged_in', TRUE);
					$this->session->set_userdata('user_access', $user_details);
					redirect("/");
				}
			}

			$this->session->set_flashdata('flash_error_login', $err_message);
			redirect("login");
		}

		$this->load->template('login', array('title' => 'Login'));
	}

	public function signup()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$params = $this->input->post();
			if (empty($params['zipcode_id'])) 
			{
				$this->session->set_flashdata('flash_error_signup', "Please fill valid zipcode.");
				redirect("login");
			}
			$err_message = "Unexpected error occured. Try again please.";
			$email_exist = $this->auth_model->email_exist($params['email']);
			if (!$email_exist)
			{
				// REGISTER USER
				/*if ($params['zipcode_id'])
				{
					$zipcode = save_zipcode($params['zipcode_id']);
					$params['zipcode_id'] = $zipcode['zipcode']['id'];
				}*/

				$params['role_id'] = ACCESS_ROLE_USER;
				$params['created_at'] = date("Y-m-d H:i:s");
				$params['password'] = md5($params['password']);
				unset($params['tnc']);
				unset($params['confirm_password']);
				
				$this->auth_model->signup($params);

				$this->session->set_flashdata('flash_success_signup', "Thanks for registering with us.");
				redirect("login");
			}

			$this->session->set_flashdata('flash_error_signup', "Please try with different email. It is already registered with us.");
			redirect("login");
		}

		$this->load->template('login', array('title' => 'Login'));
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_access');
		redirect("/");
	}
}