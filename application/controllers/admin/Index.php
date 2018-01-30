<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
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
	}

	public function index()
	{
		$data['page_title'] = 'Dashboard';

		$this->load->model(ADMIN_PREFIX . '/user_model');
		$data['total_users'] = count($this->user_model->all_records(ACCESS_ROLE_USER));

		$this->load->model(ADMIN_PREFIX . '/stores_model');
		$data['total_stores'] = count($this->stores_model->all_records());
		
		$this->load->model(ADMIN_PREFIX . '/coupons_model');
		$data['total_coupons'] = count($this->coupons_model->all_records());

		$this->load->model(ADMIN_PREFIX . '/tickets_model');
		$data['total_tickets'] = count($this->tickets_model->all_records());

		$this->load->admin_template('dashboard', $data);
	}
}