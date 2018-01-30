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
	
	public function ticket_details()
	{
		if ($this->uri->segment(2))
		{
			$data['ticket_details'] = $this->tickets_model->ticket_edit(base64_decode($this->uri->segment(2)));
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
			$this->load->template('tickets', $data);
		}
		else
		{
			redirect('login');
		}
	}
	
	public function ticket_save()
	{
		$params = $this->input->post();
		if ($this->uri->segment(2))
		{
			/***UPDATE EXISTING***/;
			$insert_id = $this->tickets_model->ticket_save($params, base64_decode($this->uri->segment(2)));
		}
		else
		{
			redirect('login');
		}

		if ($insert_id)
		{
			if (isset($params['message'])) 
			{
				$flash_message = 'Your message has been sent successfully.';
			}
			$this->session->set_flashdata('flash_message', $flash_message);
			redirect('tickets/' . $this->uri->segment(2));
		}
		else
		{
			$this->session->set_flashdata('flash_error', 'Error occured while saving Store. Please try again.');
			redirect('tickets/' . $this->uri->segment(2));
		}
	}
}