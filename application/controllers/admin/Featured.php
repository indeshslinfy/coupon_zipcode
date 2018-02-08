<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Featured extends CI_Controller
{
	/**
	 *
	 * Maps to the following URL
	 * 		http://example.com/settings
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /auth/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model(ADMIN_PREFIX . '/featured_model');
	}
	
	public function featured_categories()
	{
		$data['page_title'] = 'Popular Categories';

		$featured_ids = array();
		$data['featured_cats'] = $this->featured_model->get_featured_categories();
		foreach ($data['featured_cats'] as $keyEM => $valueEM)
		{
			array_push($featured_ids, $valueEM['id']);
		}

		$this->load->model(ADMIN_PREFIX . '/menus_model');
		$data['all_records'] = $this->menus_model->unselected_categories($featured_ids);
		$this->load->admin_template('featured/featured_categories', $data);
	}

	public function update_featured_cats()
	{
		$params = $this->input->post();
		$update_arr['updated_at'] = date("Y-m-d H:i:s");
		if (array_key_exists('add_category', $params))
		{
			$cat_ids = $params['add_category'];
			$update_arr['is_featured'] = 1;
		}
		else if (array_key_exists('remove_category', $params))
		{
			$cat_ids = $params['remove_category'];
			$update_arr['is_featured'] = 0;
		}

		if (sizeof($cat_ids) > 0)
		{
			$this->featured_model->update_featured_cats($cat_ids, $update_arr);
			$this->session->set_flashdata('flash_message', 'Popular list updated successfully');
			redirect(ADMIN_PREFIX . '/popular-categories');
		}

		$this->session->set_flashdata('flash_error', 'Select atleast one category');
		redirect(ADMIN_PREFIX . '/popular-categories');
	}

	public function featured_stores()
	{
		$data['page_title'] = 'Featured Stores';
		$data['featured_stores'] = $this->featured_model->get_featured_stores();
		$data['unfeatured_stores'] = $this->featured_model->get_unfeatured_stores();

		$this->load->admin_template('featured/featured_stores', $data);
	}

	public function update_featured_stores()
	{
		$params = $this->input->post();
		$update_arr['updated_at'] = date("Y-m-d H:i:s");
		if (array_key_exists('add_store', $params))
		{
			$store_ids = $params['add_store'];
			$update_arr['is_featured'] = 1;
		}
		else if (array_key_exists('remove_store', $params))
		{
			$store_ids = $params['remove_store'];
			$update_arr['is_featured'] = 0;
		}

		if (sizeof($store_ids) > 0)
		{
			$this->featured_model->update_featured_stores($store_ids, $update_arr);
			$this->session->set_flashdata('flash_message', 'Featured list updated successfully');
			redirect(ADMIN_PREFIX . '/featured-stores');
		}

		$this->session->set_flashdata('flash_error', 'Select atleast one store');
		redirect(ADMIN_PREFIX . '/featured-stores');
	}
}