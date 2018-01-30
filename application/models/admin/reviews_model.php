<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class reviews_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function all_records($type=false)
	{
		$where_arr = array('r.deleted_at' => NULL);
		if ($type)
		{
			$where_arr['r.review_type'] = $type;
		}

		return $this->db->select('r.*, s.store_name')
						->join('stores as s', 's.id = r.receiver_id')
						->where($where_arr)
						->get('reviews as r')
						->result_array();
	}

	public function coupon_edit($id)
	{
		return $this->db->select('c.*, s.store_name')
						->where(array('c.deleted_at' => NULL, 'c.id' => $id))
						->join('stores as s', 's.id = c.coupon_store_id')
						->get('coupons as c')
						->row_array();
	}

	public function update_review($data, $id=false)
	{
		return $this->db->where(array('id' => $id))->update('reviews', $data);
	}
}