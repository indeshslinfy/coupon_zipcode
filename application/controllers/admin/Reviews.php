<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller
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
		$this->load->model(ADMIN_PREFIX . '/reviews_model');
	}

	public function index()
	{
		if (!$this->uri->segment(3))
		{
			redirect('404');
		}

		$data['page_title'] = 'Reviews Management';
		$data['all_records'] = $this->reviews_model->all_records($this->uri->segment(3));

		$this->load->admin_template('reviews/list', $data);
	}

	public function update_review()
	{
		$params = $this->input->post();
		$update_arr = array('updated_at' => date('Y-m-d H:i:s'));
		if ($params['act'] == 'del')
		{
			$update_arr['deleted_at'] = date('Y-m-d H:i:s');
		}
		elseif ($params['act'] == 'status')
		{
			$update_arr['status'] = $params['status'];
		}

		$this->reviews_model->update_review($update_arr, $params['id']);

		$this->session->set_flashdata('flash_message', 'Review updated successfully.');
		echo json_encode(array('status' => 1, 'message' => 'Review updated successfully'));
	}
}