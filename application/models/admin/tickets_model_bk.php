<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class tickets_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	// Get all records
	public function all_records()
	{
		return $this->db->where(array('deleted_at' => NULL))
						->get('tickets')
						->result_array();
	}

	public function ticket_edit($ticket_id)
	{
		return $this->db->select('*')
								->where(array('deleted_at' => NULL, 'id' => $ticket_id))
								->get('tickets')
								->row_array();
	}

	public function ticket_messages($ticket_id)
	{
		$this->db->select('*');
		$this->db->from('tickets_message');
		$this->db->where(array('deleted_at' => NULL , 'ticket_id' => $ticket_id));
		$this->db->order_by("created_at", "asc");
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function ticket_details($ticket_id)
	{
		$this->db->select('*');
		$this->db->from('tickets');
		$this->db->where(array('deleted_at' => NULL , 'id' => $ticket_id));
		$query = $this->db->get(); 
		return $query->row_array();
	}

	public function ticket_save($data, $ticket_id=false)
	{
		try
		{
			if ($ticket_id)
			{
				if(isset($data['message']))
				{
					// INSERT New Message From Admin
					$data['created_at'] = date('Y-m-d H:i:s');
					$data['is_admin_sender'] = 1;
					$data['ticket_id'] = $ticket_id;
					$this->db->insert('tickets_message', $data);
					$inserted_id = $this->db->insert_id();

					if ($inserted_id) 
					{
						// Get Ticket information
						$data['ticket_details'] = $this->ticket_details($ticket_id);
						$data['ticket_url'] = base_url().'tickets/' . base64_encode($ticket_id);
						$email_details = $this->settings_model->get_settings('email');

						$general_settings = $this->settings_model->get_settings('general_settings');
						$data['company_name'] = $general_settings['company_name'];
						
						$html = $this->load->view('admin/emails/reply-contact-us', $data, TRUE);
						$this->email->from($email_details['admin_email'], 'Couponzipcode Admin')
									->to($data['ticket_details']['email'])
									->reply_to('no-reply@gmail.com', 'Couponzipcode Admin')
									->subject('Reply - '. $data['ticket_details']['subject'])
									->message($html);

						$this->email->send();
					}
					return $inserted_id;
				}
				else
				{
					// UPDATE Ticket Status
					$data['updated_at'] = date('Y-m-d H:i:s');
					$this->db->where(array('deleted_at' => NULL , 'id' => $ticket_id));
			 		$this->db->update('tickets', $data);
			 		return $this->db->affected_rows();
				}
			}
			else
			{
				return false;
			}
			return $id;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
}