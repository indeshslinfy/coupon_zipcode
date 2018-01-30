<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class coupons_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function all_records()
	{
		return $this->db->select('c.*, s.store_name, z.zipcode as coupon_zipcode')
						->where(array('c.deleted_at' => NULL))
						->join('stores as s', 's.id = c.coupon_store_id')
						->join('zipcodes as z', 'z.id = c.coupon_zipcode_id')
						->get('coupons as c')
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

	public function coupon_save($data, $id=false)
	{
		try
		{
			if ($id)
			{				
				// UPDATE COUPON
				$data['updated_at'] = date('Y-m-d H:i:s');
				$this->db->where(array('id' => $id))->update('coupons', $data);
			}
			else
			{
				// SAVE COUPON
				$data['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('coupons', $data);
				$id = $this->db->insert_id();
				if (!$id)
				{
					return false;
				}
			}

			return $id;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
}