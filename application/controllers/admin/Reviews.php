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

		//Get the average rating
		$this->db->select_avg('rating');
		$this->db->from('reviews');
		$this->db->where(array('review_type' => REVIEW_TYPE_STORE, 'status' => REVIEW_STATUS_APPROVE, 'deleted_at' => NULL, 'receiver_id' => $params['store_id']));
		$query = $this->db->get(); 
		$result = $query->row_array();
		$avg_rating = number_format($result['rating'],2);
		$avg_explode = explode('.', $avg_rating);
		if ($avg_explode[1] == 50 || $avg_explode[1] == 00) 
		{
			$avg_rating = $avg_rating;
		}
		else if ($avg_explode[1] > 00 && $avg_explode[1] <= 50) 
		{
			$avg_rating = $avg_explode[0] + 0.50;
		}
		elseif ($avg_explode[1] >= 51 && $avg_explode[1] <= 99) 
		{
			$avg_rating = $avg_explode[0] + 1;
		}
		$this->db->where(array("id" => $params['store_id']))
				->update('stores', array('store_rating' => number_format($avg_rating, 2),
										'updated_at' => date('Y-m-d H:i:s')));
		$this->session->set_flashdata('flash_message', 'Review updated successfully.');
		echo json_encode(array('status' => 1, 'message' => 'Review updated successfully'));
	}
}