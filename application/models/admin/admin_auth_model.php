<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class admin_auth_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
		self::authenticate_login();
	}

	public function user_login($params)
	{
		return $this->db->where(array('email' => $params['email'],
								'password' => md5($params['password']),
								'deleted_at' => NULL,
								'role_id' => ACCESS_ROLE_ADMIN))
						->get('user')
						->row_array();
	}

	public function authenticate_login()
	{
		if (!$this->session->userdata('admin_logged_in'))
		{
			if (ADMIN_PREFIX . "/" . $this->router->fetch_class() . "/" . $this->router->fetch_method() == ADMIN_PREFIX . '/auth/login')
			{
				return true;
			}
			
			redirect(ADMIN_PREFIX . '/login');
		}
		else
		{
			if (ADMIN_PREFIX . "/" . $this->router->fetch_class() . "/" . $this->router->fetch_method() == ADMIN_PREFIX . '/auth/login')
			{
				redirect(ADMIN_PREFIX);
			}
			
			return true;
		}
	}
}