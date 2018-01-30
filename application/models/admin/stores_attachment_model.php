<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class stores_attachment_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function store_attachments($store_id, $type=null)
	{
		$where_arr = array('deleted_at' => NULL, 'store_id' => $store_id);
		if ($type)
		{
			$where_arr['attachment_type'] = $type;
		}

		return $this->db->where($where_arr)
						->order_by('created_at', 'DESC')
						->get('stores_attachment')
						->result_array();
	}

	public function attachment_update($id, $update_arr)
	{
		return $this->db->where(array('id' => $id))->update('stores_attachment', $update_arr);
	}

	public function store_attachment_update($id, $update_arr)
	{
		return $this->db->where(array('store_id' => $id))->update('stores_attachment', $update_arr);
	}
}