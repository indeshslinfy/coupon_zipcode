<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function all_records()
	{
		return $this->db->where(array('deleted_at' => NULL))
						->where('id >', 1)
						->get('roles')
						->result_array();
	}
}