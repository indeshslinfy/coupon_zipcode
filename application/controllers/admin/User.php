<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
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

		$this->load->model('roles_model');
		$this->load->model(ADMIN_PREFIX . '/user_model');
	}

	public function index()
	{
		$data['page_title'] = 'Users Management';

		$data['all_users'] = $this->user_model->all_records(ACCESS_ROLE_USER);
		$this->load->admin_template('user/list', $data);
	}

	public function user_edit()
	{
		$data['all_roles'] = $this->roles_model->all_records();
		if ($this->uri->segment(3))
		{
			$data['user_details'] = $this->user_model->user_edit($this->uri->segment(3));
			if (sizeof($data['user_details']) == 0)
			{
				$this->session->set_flashdata('flash_error', 'User does not exist');
				redirect(ADMIN_PREFIX .'/users');
			}

			$this->load->admin_template('user/edit', $data);
		}
		else
		{
			$this->load->admin_template('user/add', $data);
		}
	}

	public function user_save()
	{
		if ($this->uri->segment(3))
		{
			$insert_id = $this->user_model->user_save($this->input->post(), $this->uri->segment(3));
			$this->session->set_flashdata('flash_message', 'User updated successfully.');
		}
		else
		{
			$insert_arr = $this->input->post();
			$insert_arr['password'] = md5($this->input->post('password'));

			$insert_id = $this->user_model->user_save($insert_arr);
			$this->session->set_flashdata('flash_message', 'User saved successfully.');
		}

		if ($insert_id)
		{
			redirect(ADMIN_PREFIX . '/edit-user/' . $insert_id);
		}

		redirect(ADMIN_PREFIX . '/add-user');

	}

	public function user_delete()
	{
		try
		{
			$update_id = $this->user_model->user_delete($this->input->post('id'), array("deleted_at" => date("Y-m-d H:i:s")));
			$this->session->set_flashdata('flash_message', 'User deleted successfully.');
			echo json_encode(array("status" => 1, "message" => "User deleted successfully."));die;
		}
		catch (Exception $e)
		{
			$this->session->set_flashdata('flash_message', 'Error while deleting user. Please try again.');
			echo json_encode(array("status" => 0, "message" => "Error while deleting user. Please try again."));die;
		}
	}
}