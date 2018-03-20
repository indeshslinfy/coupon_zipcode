<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_model
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
								'role_id' => ACCESS_ROLE_USER))
						->get('user')
						->row_array();
	}

	public function email_exist($email)
	{
		return $this->db->where(array('email' => $email,
									'deleted_at' => NULL))
						->get('user')
						->row_array();
	}

	public function authenticate_login()
	{
		// check_location_cookie();
		if (!$this->session->userdata('logged_in'))
		{
			$allowed = array('home/index',
							'auth/login',
							'auth/signup',
							'error/show_404',
							'Home/zap',
							'home/get_cities',
							'home/get_geo_location',
							'home/get_zipcode_stores',
							'home/save_new_zipcode',
							'home/search_zipcode',
							'home/popular_stores',
							'tickets/ticket_details',
							'tickets/ticket_save',
							'coupons/list_categories',
							'coupons/list_deals',
							'coupons/like_unlike_store',
							'coupons/submit_store_review',
							'coupons/coupon_details',
							'coupons/coupon_print',
							'coupons/load_more',
							'cron/expire_old_coupons',
							'cron/sync_ebay_categories',
							'index/static_page',
							'index/average',
							'index/subscribe_newsletter',
							'index/roundUpToAny',
							'index/contact_us');
			if (!in_array($this->router->fetch_class() . "/" . $this->router->fetch_method(), $allowed))
			{
				redirect('login');
			}
		}
		elseif ($this->session->userdata('logged_in') && $this->router->fetch_method() == 'login')
		{
			redirect('/');
		}
	}

	public function signup($params)
	{
		$this->db->insert('user', $params);
		return $this->db->insert_id();
	}
}