<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
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

		$this->load->model(ADMIN_PREFIX . '/admin_auth_model');
	}

	public function login()
	{
		if ($this->session->userdata('admin_logged_in'))
		{
			redirect(ADMIN_PREFIX);
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$flash_message = "Login failed. You account is not active";
			$user_exist = $this->admin_auth_model->user_login(array("email" => $this->input->post('email'), "password" => $this->input->post('password')));
			if ($user_exist)
			{
				$flash_message = "";
				if ($user_exist['status'] == USER_STATUS_INACTIVE)
				{
					$flash_message = "Login failed. You account is not active";
				}

				$this->session->set_userdata('admin_logged_in', TRUE);
				$this->session->set_userdata('admin_access', $user_exist);
				
				$this->session->set_flashdata('flash_message', $flash_message);
				redirect(ADMIN_PREFIX);
			}

			$this->session->unset_userdata('admin_logged_in');
			$this->session->set_flashdata('flash_message', 'Login failed. Invalid Email or Password.');
			redirect(ADMIN_PREFIX . "/login");
		}

		$this->load->admin_template('login', array('title' => 'Admin Login'), false);
	}

	public function logout()
	{
		$this->session->unset_userdata('admin_logged_in');
		redirect(ADMIN_PREFIX . '/login');
	}
}