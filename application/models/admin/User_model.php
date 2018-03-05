<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function all_records($role_id=false)
	{
		$where_arr = array('deleted_at' => NULL);
		if ($role_id)
		{
			$where_arr['role_id'] = $role_id;
		}

		return $this->db->where($where_arr)
						->get('user')
						->result_array();
	}

	public function user_edit($user_id)
	{
		return $this->db->select('zip.zipcode, u.*')
						->where(array('u.deleted_at' => NULL, 'u.id' => $user_id))
						->join('zipcodes as zip', 'zip.id = u.zipcode_id', 'left')
						->get('user as u')
						->row_array();
	}

	public function user_save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where(array('id' => $id))->update('user', $data);
			return $id;
		}

		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	public function user_delete($id, $update_arr)
	{
		return $this->db->where(array('id' => $id))
						->update('user', $update_arr);
	}
}