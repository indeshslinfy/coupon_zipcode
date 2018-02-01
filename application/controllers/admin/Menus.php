<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller
{
	/**
	 *
	 * Maps to the following URL
	 * 		http://example.com/reviews
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /auth/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model(ADMIN_PREFIX . '/menus_model');
	}

	public function index()
	{
		$data['page_title'] = 'Menus Management';

		$menu_ids = array();
		$existing_menus = get_settings('frontend_menu');
		foreach ($existing_menus as $keyEM => $valueEM)
		{
			array_push($menu_ids, $valueEM['id']);
		}

		$data['all_records'] = $this->menus_model->unselected_categories($menu_ids);
		$this->load->admin_template('menus/list', $data);
	}
}