<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller
{
	/**
	 *
	 * Maps to the following URL
	 * 		http://example.com/tickets
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /auth/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model(ADMIN_PREFIX . '/tickets_model');
	}

	public function index()
	{
		$data['page_title'] = 'Tickets Management';
		$data['all_records'] = $this->tickets_model->all_records();

		$this->load->admin_template('tickets/list', $data);
	}
	
	public function ticket_edit()
	{
		if ($this->uri->segment(3))
		{
			$data['ticket_details'] = $this->tickets_model->ticket_edit($this->uri->segment(3));
			if (sizeof($data['ticket_details']) == 0)
			{
				redirect('404');
			}

			if ($data['ticket_details']['status'] == TICKET_STATUS_OPEN) 
			{
				$data['ticket_status'] = 'Opened';
			}
			else if ($data['ticket_details']['status'] == TICKET_STATUS_CLOSE) 
			{
				$data['ticket_status'] = 'Closed';
			}
			else if ($data['ticket_details']['status'] == TICKET_STATUS_ANSWER) 
			{
				$data['ticket_status'] = 'Answered';
			}
			$data['ticket_details']['messages'] = $this->tickets_model->ticket_messages($data['ticket_details']['id']);

			$count = count($data['ticket_details']['messages']);
			$data['ticket_details']['last_message'] = $data['ticket_details']['messages'][$count-1];
			$this->load->admin_template('tickets/edit', $data);
		}
		else
		{
			redirect('tickets');
		}
	}
	
	public function ticket_save()
	{
		$params = $this->input->post();
		if ($this->uri->segment(3))
		{
			/***UPDATE EXISTING***/
			$insert_id = $this->tickets_model->ticket_save($params, $this->uri->segment(3));
		}
		else
		{
			/***SAVE NEW***/
			$insert_id = $this->tickets_model->ticket_save($insert_arr);
		}

		if ($insert_id)
		{
			$flash_message = 'Ticket status updated successfully.';
			if (isset($params['message'])) 
			{
				$flash_message = 'Your message has been sent successfully.';
			}
			$this->session->set_flashdata('flash_message', $flash_message);
			redirect(ADMIN_PREFIX . '/edit-ticket/' . $this->uri->segment(3));
		}
		else
		{
			$this->session->set_flashdata('flash_error', 'Error occured while saving Store. Please try again.');
			redirect(ADMIN_PREFIX . '/tickets');
		}
	}
}