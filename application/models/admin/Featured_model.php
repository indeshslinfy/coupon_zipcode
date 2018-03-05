<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Featured_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function favorite_categories($except=false)
	{
		$cats = $this->db->where(array('deleted_at' => NULL));
			if ($except && sizeof($except) > 0)
			{
				$cats = $cats->where_not_in('id', $except);
			}
		$cats = $cats->order_by('store_category_name', 'ASC')
				->get('stores_category')
				->result_array();

		return $cats;
	}

	public function get_featured_categories()
	{
		return $this->db->where(array('is_featured' => 1, 'deleted_at' => NULL))
						->order_by('store_category_name', 'ASC')
						->get('stores_category')
						->result_array();
	}

	public function update_featured_cats($cat_ids, $update_arr)
	{
		return $this->db->where_in('id', $cat_ids)->update('stores_category', $update_arr);
	}

	public function get_featured_stores($limit=false)
	{
		return  $this->db->where(array('is_featured' => 1, 'deleted_at' => NULL))
						->order_by('store_name', 'ASC')
						->get('stores')->result_array();
	}

	public function get_unfeatured_stores()
	{
		return $this->db->select('cpn.id, stores.*')
						->where(array('stores.is_featured' => 0, 'stores.deleted_at' => NULL, 'cpn.deleted_at' => NULL, 'cpn.status' => COUPON_STATUS_ACTIVE))
						->join('coupons as cpn', 'stores.id=cpn.coupon_store_id')
						->order_by('store_name', 'ASC')
						->get('stores')
						->result_array();
	}

	public function update_featured_stores($store_ids, $update_arr)
	{
		return $this->db->where_in('id', $store_ids)->update('stores', $update_arr);
	}
}