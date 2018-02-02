<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stores_Category extends CI_Controller
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
		$this->load->model(ADMIN_PREFIX . '/stores_category_model');
	}

	public function index()
	{
		$data['page_title'] = 'Stores Category Management';
		$data['all_records'] = $this->stores_category_model->all_records();

		$this->load->admin_template('stores_category/list', $data);
	}
	
	public function stores_cat_edit()
	{
		if ($this->uri->segment(3))
		{
			$data['store_cat_details'] = $this->stores_category_model->stores_cat_edit($this->uri->segment(3));
			if (sizeof($data['store_cat_details']) == 0)
			{
				redirect('404');
			}
			
			$this->load->admin_template('stores_category/edit', $data);
		}
		else
		{
			$this->load->admin_template('stores_category/add');
		}
	}
	
	public function stores_cat_save()
	{
		if ($this->uri->segment(3))
		{
			$cat_id = $this->uri->segment(3);
			$insert_arr = $this->input->post();
			$insert_arr['store_category_slug'] = $this->unique_cat_slug($insert_arr['store_category_name'], $cat_id);
			$this->stores_category_model->stores_cat_update($insert_arr, $cat_id);
			
			$this->session->set_flashdata('flash_message', 'Category updated successfully.');
		}
		else
		{
			$insert_arr = $this->input->post();
			
			$insert_arr['store_category_slug'] = $this->unique_cat_slug($insert_arr['store_category_name']);
			$cat_id = $this->stores_category_model->stores_cat_update($insert_arr);

			$this->session->set_flashdata('flash_message', 'Category saved successfully.');
		}
		
		if ($cat_id)
		{
			redirect(ADMIN_PREFIX . '/edit-store-category/' . $cat_id);
		}

		$this->session->set_flashdata('flash_message', 'Unexpected error occured. Please try again.');
		redirect(ADMIN_PREFIX . '/add-store-category');
	}

	public function store_cat_delete()
	{
		try
		{
			$menu_removed = false;
			$old_menus = get_settings('frontend_menu');
			foreach ($old_menus as $key => $value) 
			{
				if ($value['id'] == $this->input->post('id')) 
				{
					$menu_removed = true;
					unset($old_menus[$key]);
					break;
				}
			}

			if ($menu_removed)
			{
				$this->load->model(ADMIN_PREFIX . '/settings_model');
				$this->settings_model->save_settings(array("frontend_menu" => $old_menus));
			}
			
			$update_id = $this->stores_category_model->stores_cat_update(array("deleted_at" => date("Y-m-d H:i:s")), $this->input->post('id'));
			$this->session->set_flashdata('flash_message', 'Category deleted successfully.');
			echo json_encode(array("status" => 1, "message" => "Category deleted successfully."));die;
		}
		catch (Exception $e)
		{
			$this->session->set_flashdata('flash_message', 'Error while deleting category. Please try again.');
			echo json_encode(array("status" => 0, "message" => "Error while deleting category. Please try again."));die;
		}
	}

	function unique_cat_slug($cat_name, $cat_id=false)
	{
		$slug = slugify($cat_name);
		$slug_exist = $this->stores_category_model->store_cat_slug_exist($slug, $cat_id);
		if ($slug_exist)
		{
			$slug = $this->unique_cat_slug($cat_name . " " . rand(1, 99));
		}

		return $slug;
	}
}