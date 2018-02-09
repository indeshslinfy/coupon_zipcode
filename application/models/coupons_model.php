<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class coupons_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function coupon_details($coupon_id)
	{
		return $this->db->select('s.*, store_atch.attachment_path as store_image, adr.*, cty.city_name, stt.state_name, cntry.country_name, c.*, (SELECT COUNT(id) FROM stores_like WHERE store_id = c.coupon_store_id AND status = ' . STORE_LIKE . ') as store_likes, (SELECT COUNT(id) FROM stores_like WHERE store_id = c.coupon_store_id AND status = ' . STORE_UNLIKE . ') as store_unlikes, zip.zipcode as coupon_zipcode')
						->where(array('c.id' => $coupon_id,
									'c.deleted_at' => NULL,
									's.status' => STORE_STATUS_ACTIVE,
									's.deleted_at' => NULL))
						->join('zipcodes as zip', 'zip.id = c.coupon_zipcode_id')
						->join('stores as s', 's.id = c.coupon_store_id')
						->join('address as adr', 'adr.id = s.store_address_id')
						->join('cities as cty', 'cty.id = adr.address_city_id')
						->join('states as stt', 'stt.id = adr.address_state_id')
						->join('countries as cntry', 'cntry.id = adr.address_country_id')
						->join('(SELECT atch.store_id, atch.attachment_path FROM stores_attachment as atch WHERE atch.attachment_type = ' . STORE_ATCH_IMAGE . ' AND atch.deleted_at IS NULL ORDER BY atch.created_at DESC) as store_atch', 's.id = store_atch.store_id' , 'left')
						->get('coupons as c')
						->row_array();
	}

	public function user_store_records($user_id, $store_id)
	{
		return $this->db->select('s.id as store_id, (SELECT COUNT(id) FROM stores_like WHERE store_id = s.id AND status = ' . STORE_LIKE . ' AND user_id = ' . $user_id . ') as is_liked,
			(SELECT COUNT(id) FROM stores_like WHERE store_id = s.id AND status = ' . STORE_UNLIKE . ' AND user_id = ' . $user_id . ') as is_unliked,
			(SELECT COUNT(id) FROM reviews WHERE receiver_id = s.id AND review_type = ' . REVIEW_TYPE_STORE . ' AND reviewer_id = ' . $user_id . ') as is_reviewed')
						->where(array('s.id' => $store_id))
						->get('stores as s')
						->row_array();
	}

	public function store_menus($store_id)
	{
		return $this->db->select('id, attachment_path')
						->where(array('store_id' => $store_id, 'attachment_type' => STORE_ATCH_MENU, 'deleted_at' => NULL))
						->order_by('created_at', 'DESC')
						->get('stores_attachment')
						->result_array();
	}

	public function store_reviews($store_id, $limit=false)
	{
		$reviews = $this->db->where(array('receiver_id' => $store_id, 'review_type' => REVIEW_TYPE_STORE, 'deleted_at' => NULL, 'status' => REVIEW_STATUS_APPROVE))
						->order_by('created_at', 'DESC');

		if ($limit)
		{
			$reviews = $reviews->limit($limit);
		}

		return $reviews->get('reviews')->result_array();
	}

	public function store_coupons($store_id, $data=false)
	{
		$coupons = $this->db->select('id, coupon_title, created_at')
							->where(array('deleted_at' => NULL, 'status' => COUPON_STATUS_ACTIVE, 'coupon_store_id' => $store_id));
		if ($data && isset($data['except']))
		{
			$coupons = $coupons->where('id !=', $data['except']);
		}

		return $coupons->order_by('created_at', 'DESC')
						->get('coupons')
						->result_array();
	}

	public function store_timetable($store_id)
	{
		return $this->db->where(array('deleted_at' => NULL, 'store_id' => $store_id))
							->order_by('created_at', 'DESC')
							->get('stores_timetable')
							->row_array();
	}

	public function like_unlike_store($params)
	{
		$is_exist = $this->db->where(array("user_id" => $params['user_id'], "store_id" => $params['store_id']))
						->get('stores_like')
						->row_array();
		if ($is_exist)
		{
			// UPDATE EXISTING
			if ($params['status'] && ($is_exist['status'] == $params['status']))
			{
				// IF ALREADY LIKED
				return array('status' => 0, 'message' => 'Store Already Liked');
			}
			elseif ((!$params['status']) && ($is_exist['status'] == $params['status']))
			{
				// IF ALREADY UNLIKED
				return array('status' => 0, 'message' => 'Store Already Unliked');
			}

			$params['updated_at'] = date('Y-m-d H:i:s');
			$this->db->where(array("id" => $is_exist['id']))->update('stores_like', $params);

			return array('status' => 1, 'id' => $is_exist['id']);
		}

		// ADD NEW
		$params['created_at'] = date('Y-m-d H:i:s');
		$this->db->insert('stores_like', $params);

		return array('status' => 1, 'id' => $this->db->insert_id());
	}

	public function submit_store_review($params)
	{
		$where_arr = array("receiver_id" => $params['receiver_id']);
		if ($params['reviewer_id'])
		{
			$where_arr['reviewer_id'] = $params['reviewer_id'];
		}

		$is_exist = $this->db->where($where_arr)->get('reviews')->row_array();
		if ($is_exist)
		{
			// UPDATE EXISTING
			$params['updated_at'] = date('Y-m-d H:i:s');
			$this->db->where(array("id" => $is_exist['id']))->update('reviews', $params);
			$params['created_at'] = $is_exist['created_at'];

			return array('status' => 1, 'data' => $params);
		}

		// ADD NEW
		$params['created_at'] = date('Y-m-d H:i:s');
		$this->db->insert('reviews', $params);
		$params['id'] = $this->db->insert_id();

		return array('status' => 1, 'data' => $params);
	}

	public function popular_coupons()
	{
		return $this->db->select('*')
							->where(array('deleted_at' => NULL, 'status' => COUPON_STATUS_ACTIVE))
							->limit(3)
							->get('coupons')
							->result_array();
	}
}