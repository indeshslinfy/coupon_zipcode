<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupons extends CI_Controller
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
		$this->load->model(ADMIN_PREFIX . '/coupons_model');
	}

	public function index()
	{
		$data['page_title'] = 'Coupons Management';
		$data['all_records'] = $this->coupons_model->all_records();

		$this->load->admin_template('coupons/list', $data);
	}
	
	public function coupon_edit()
	{
		$data['all_zipcodes'] = get_zipcodes();
		if ($this->uri->segment(3))
		{
			$data['coupon_details'] = $this->coupons_model->coupon_edit($this->uri->segment(3));
			if (sizeof($data['coupon_details']) == 0)
			{
				$this->session->set_flashdata('flash_error', 'Coupon does not exist');
				redirect(ADMIN_PREFIX .'/coupons');
			}

			$this->load->admin_template('coupons/edit', $data);
		}
		else
		{
			$this->load->admin_template('coupons/add', $data);
		}
	}
	
	public function coupon_save()
	{
		$insert_arr = $this->input->post();
		$insert_arr['coupon_start_date'] = date('Y-m-d H:i:s', strtotime($insert_arr['coupon_start_date']));
		$insert_arr['coupon_end_date'] = date('Y-m-d H:i:s', strtotime($insert_arr['coupon_end_date']));
		
		// if ($insert_arr['coupon_publish'] == '1')
		// {
			if (strtotime($insert_arr['coupon_start_date']) > strtotime(date("Y-m-d H:i:s")))
			{
				$insert_arr['status'] = COUPON_STATUS_FUTURE;
			}
			elseif (strtotime($insert_arr['coupon_end_date']) < strtotime(date("Y-m-d H:i:s")))
			{
				$insert_arr['status'] = COUPON_STATUS_EXPIRED;
			}
			elseif (strtotime($insert_arr['coupon_start_date']) <= strtotime(date("Y-m-d H:i:s")) && strtotime($insert_arr['coupon_end_date']) >= strtotime(date("Y-m-d H:i:s")))
			{
				$insert_arr['status'] = COUPON_STATUS_ACTIVE;
			}
			else
			{
				$insert_arr['status'] = COUPON_STATUS_INACTIVE;
			}
		// }
		// else
		// {
		// 	$data['status'] = COUPON_STATUS_EXPIRED;
		// }

		if ($insert_arr['status'] == COUPON_STATUS_EXPIRED)
		{
			$insert_arr['coupon_publish'] = '0';
		}

		if ($this->uri->segment(3))
		{
			/***UPDATE EXISTING***/
			$insert_arr['updated_at'] = date('Y-m-d H:i:s');
			$insert_id = $this->coupons_model->coupon_save($insert_arr, $this->uri->segment(3));
			$this->session->set_flashdata('flash_message', 'Coupon updated successfully.');
		}
		else
		{
			/***SAVE NEW***/
			$insert_arr['created_at'] = date('Y-m-d H:i:s');
			$insert_id = $this->coupons_model->coupon_save($insert_arr);
			$this->session->set_flashdata('flash_message', 'Coupon saved successfully.');
		}

		if ($insert_id)
		{
			redirect(ADMIN_PREFIX . '/edit-coupon/' . $insert_id);
		}
		else
		{
			$this->session->set_flashdata('flash_error', 'Error occured while saving Coupon. Please try again.');
			redirect(ADMIN_PREFIX . '/add-coupon');
		}
	}

	public function coupon_delete()
	{
		try
		{
			$this->coupons_model->coupon_save(array("deleted_at" => date("Y-m-d H:i:s"), "updated_at" => date('Y-m-d H:i:s')), $this->input->post('id'));

			$this->session->set_flashdata('flash_message', 'Coupon deleted successfully.');
			echo json_encode(array("status" => 1));die;
		}
		catch (Exception $e)
		{
			echo json_encode(array("status" => 0, "message" => "Error while deleting Coupon. Please try again."));die;
		}
	}
}